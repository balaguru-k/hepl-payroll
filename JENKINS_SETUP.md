# Jenkins Integration Guide for HEPL Payroll

## Prerequisites
- Jenkins 2.361+
- Docker & Docker Compose installed
- SonarQube instance running
- Git repository access

## Jenkins Plugin Requirements

Install these plugins in Jenkins:
- Pipeline
- Pipeline: Multibranch
- Docker Pipeline
- SonarQube Scanner
- GitHub/GitLab Integration (if using)
- Blue Ocean (recommended)
- Credentials Binding
- Environmental Injector

## Step 1: Create Credentials in Jenkins

### 1.1 Docker Hub Credentials
1. Go to **Jenkins** → **Manage Jenkins** → **Manage Credentials**
2. Click **Add Credentials** (Global domain)
3. Kind: **Username with password**
   - Username: `your_dockerhub_username`
   - Password: `your_dockerhub_token`
   - ID: `docker-hub-creds`

### 1.2 SonarQube Token
1. Go to **SonarQube** → **User** → **Security**
2. Generate a new token
3. In Jenkins, add credentials:
   - Kind: **Secret text**
   - Secret: `your_sonarqube_token`
   - ID: `sonar-token`

### 1.3 Database Credentials (if needed)
1. Kind: **Username with password**
   - Username: `payroll_user`
   - Password: `your_db_password`
   - ID: `db-creds`

### 1.4 Git Repository Credentials (if private)
1. Kind: **SSH Key** or **Username with password**
2. Configure as per your repository type

## Step 2: Configure Jenkins Pipeline Job

### Option A: Declarative Pipeline (UI)
1. Create new **Pipeline** job
2. Configure:
   - **Pipeline script from SCM**
   - SCM: **Git**
   - Repository URL: `https://github.com/yourorg/hepl-payroll.git`
   - Credentials: Select created credentials
   - Branches to build: `*/develop`, `*/staging`, `*/main`
   - Script path: `Jenkinsfile`

### Option B: Jenkins Configuration as Code
If using JCasC, add to `jenkins.yaml`:

```yaml
jenkins:
  jobs:
    - script: >
        pipelineJob('hepl-payroll') {
          definition {
            cps {
              script(readFileAsString('Jenkinsfile'))
              sandbox(true)
            }
          }
        }
```

## Step 3: Environment Variables Setup

In Jenkins job configuration, add environment variables:

```
DOCKER_REGISTRY=docker.io
DOCKER_USERNAME=${DOCKER_USERNAME}
DOCKER_PASSWORD=${DOCKER_PASSWORD}
SONAR_HOST_URL=http://sonarqube-server:9000
SONAR_LOGIN_TOKEN=${SONAR_LOGIN_TOKEN}
SONAR_PROJECT_KEY=hepl-payroll
APP_NAME=hepl-payroll
BUILD_DATE=$(date -u +'%Y-%m-%dT%H:%M:%SZ')
```

## Step 4: Configure Webhooks (Auto-trigger on Push)

### For GitHub
1. Go to your GitHub repository
2. **Settings** → **Webhooks** → **Add webhook**
3. Payload URL: `http://your-jenkins:8080/github-webhook/`
4. Content type: `application/json`
5. Events: **Push events**, **Pull requests**

### For GitLab
1. Go to your GitLab project
2. **Settings** → **Webhooks**
3. URL: `http://your-jenkins:8080/project/hepl-payroll`
4. Trigger: **Push events**, **Merge request events**

### For Bitbucket
1. Go to **Repository settings** → **Webhooks**
2. URL: `http://your-jenkins:8080/bitbucket-hook/`
3. Events: **Push**, **Pull Request**

## Step 5: Configure SonarQube Integration

### In SonarQube
1. Go to **Administration** → **Configuration** → **Webhooks**
2. Create webhook:
   - Name: `Jenkins`
   - URL: `http://your-jenkins:8080/sonarqube-webhook/`
   - Event: **Quality Gate**

### In Jenkins
1. Go to **Manage Jenkins** → **Configure System**
2. Find **SonarQube servers**
3. Add SonarQube server:
   - Name: `SonarQube`
   - Server URL: `http://sonarqube-server:9000`
   - Server auth token: Select `sonar-token` credentials

## Step 6: Run Pipeline

### Trigger Options

**Manual Trigger:**
```bash
# Via Jenkins UI or API
curl -X POST http://jenkins:8080/job/hepl-payroll/buildWithParameters \
  -u user:token \
  -F token=YOUR_BUILD_TOKEN
```

**Git Webhook (Automatic):**
- Commit and push to `develop`, `staging`, or `main`
- Jenkins automatically detects and runs pipeline

**Scheduled:**
In Jenkins pipeline definition:
```groovy
triggers {
    pollSCM('H */4 * * *') // Every 4 hours
}
```

## Step 7: Monitor Pipeline Execution

### Jenkins UI
1. Open job → **Build History**
2. Click build number to view logs
3. Go to **Console Output** to see full logs

### Blue Ocean (Recommended)
1. Install Blue Ocean plugin
2. Access: `http://jenkins:8080/blue/`
3. Visual pipeline representation with real-time logs

## Step 8: Post-Build Actions

### Archive Artifacts
```groovy
archiveArtifacts artifacts: 'build-artifacts/**'
```

### Email Notifications
```groovy
emailext(
    subject: '${DEFAULT_SUBJECT}',
    body: '${DEFAULT_CONTENT}',
    to: 'devops@example.com'
)
```

### Slack Notifications
```groovy
slackSend(
    color: '${BUILD_STATUS}' == 'SUCCESS' ? 'good' : 'danger',
    message: "${env.JOB_NAME} #${env.BUILD_NUMBER} - ${BUILD_STATUS}"
)
```

## Troubleshooting

### Docker Login Fails
- Check credentials: `echo $DOCKER_PASSWORD | docker login -u $DOCKER_USERNAME`
- Ensure token has sufficient permissions
- Check `.dockerignore` for correct format

### SonarQube Analysis Fails
- Verify SonarQube is running: `curl http://sonarqube-server:9000`
- Check token validity: `curl -u $SONAR_TOKEN: http://sonarqube-server:9000/api/system/status`
- Review `sonar-project.properties` for syntax errors

### Container Deployment Fails
- Check Docker daemon: `docker ps`
- Review container logs: `docker logs hepl-payroll-{env}`
- Verify ports are available: `netstat -an | grep LISTEN`

### Database Connection Issues
- Test connection: `mysql -h $DB_HOST -u $DB_USER -p$DB_PASSWORD`
- Check environment variables are set
- Verify database exists and user has permissions

## Performance Optimization

1. **Parallel Execution:**
```groovy
parallel(
    'Code Quality': { /* sonar stage */ },
    'Docker Build': { /* docker build */ }
)
```

2. **Caching Dependencies:**
```groovy
sh 'docker build --cache-from ${DOCKER_IMAGE}:latest ...'
```

3. **Resource Limits:**
```groovy
agent {
    docker {
        image 'php:7.4'
        args '-m 1G'
    }
}
```

## Security Best Practices

1. Use Jenkins Credentials for all secrets
2. Enable audit logging
3. Use service accounts for deployments
4. Rotate tokens regularly
5. Encrypt sensitive environment variables
6. Use HTTPS for Jenkins URL
7. Implement rate limiting on webhooks

## References

- [Jenkins Documentation](https://www.jenkins.io/doc/)
- [Docker Pipeline Plugin](https://plugins.jenkins.io/docker-workflow/)
- [SonarQube Integration](https://docs.sonarqube.org/latest/analysis/jenkins/)
- [OWASP Jenkins Security](https://owasp.org/www-project-jenkins/)
