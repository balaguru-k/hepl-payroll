# HEPL Payroll - Complete Deployment & CI/CD Guide

## Table of Contents
1. [Quick Start](#quick-start)
2. [Docker Setup](#docker-setup)
3. [Jenkins Integration](#jenkins-integration)
4. [SonarQube Analysis](#sonarqube-analysis)
5. [Deployment Environments](#deployment-environments)
6. [Troubleshooting](#troubleshooting)

---

## Quick Start

### Prerequisites
- Docker & Docker Compose
- PHP 7.4+
- Node.js & npm
- Composer
- Git

### Local Development Setup

```bash
# Clone repository
git clone https://github.com/yourorg/hepl-payroll.git
cd hepl-payroll

# Make deploy script executable (Linux/Mac)
chmod +x deploy.sh

# Deploy to development
./deploy.sh dev
# OR on Windows:
deploy.bat dev
```

Access the application:
- **Web Application**: http://localhost:8080
- **PHPMyAdmin**: http://localhost:8888 (dev only)
- **Database**: localhost:3306

---

## Docker Setup

### Dockerfile Overview
The `Dockerfile` includes:
- PHP 7.4 with Apache
- Required PHP extensions (PDO, MySQL, Zip)
- Composer integration
- Health checks
- Proper permission setup

### Build Docker Image

```bash
# Build with specific tag
docker build -t hepl-payroll:v1.0 -t hepl-payroll:latest .

# Build with build arguments
docker build \
  --build-arg BUILD_DATE=$(date -u +'%Y-%m-%dT%H:%M:%SZ') \
  --build-arg VCS_REF=$(git rev-parse --short HEAD) \
  --build-arg VERSION=1.0 \
  -t hepl-payroll:latest .
```

### Docker Compose Environments

#### Development (`docker-compose.dev.yml`)
```bash
docker-compose -f docker-compose.dev.yml up -d

# Services:
# - Web (PHP/Apache): Port 8080
# - MySQL: Port 3306
# - PHPMyAdmin: Port 8888
```

#### Staging (`docker-compose.staging.yml`)
```bash
docker-compose -f docker-compose.staging.yml up -d

# Services:
# - Web (PHP/Apache): Port 8081
# - MySQL: Port 3307
```

#### Production (`docker-compose.prod.yml`)
```bash
docker-compose -f docker-compose.prod.yml up -d

# Services:
# - Web (PHP/Apache): Port 80/443
# - Nginx Reverse Proxy: Port 443
```

### Useful Docker Commands

```bash
# View logs
docker-compose -f docker-compose.dev.yml logs -f

# Stop all services
docker-compose -f docker-compose.dev.yml down

# Restart specific service
docker-compose -f docker-compose.dev.yml restart web

# Execute command in container
docker-compose -f docker-compose.dev.yml exec web bash

# View container status
docker-compose -f docker-compose.dev.yml ps

# Remove volumes (careful!)
docker-compose -f docker-compose.dev.yml down -v

# Rebuild images
docker-compose -f docker-compose.dev.yml up -d --build
```

---

## Jenkins Integration

### Setup Overview
See [JENKINS_SETUP.md](JENKINS_SETUP.md) for detailed instructions.

### Quick Jenkins Setup

1. **Install Jenkins Plugins**
   - Pipeline
   - Docker Pipeline
   - SonarQube Scanner
   - GitHub Integration (or GitLab/Bitbucket)

2. **Create Credentials**
   ```
   Docker Hub:        ID: docker-hub-creds
   SonarQube Token:   ID: sonar-token
   Database:          ID: db-creds
   Git SSH/Token:     ID: git-creds
   ```

3. **Create Pipeline Job**
   - Type: **Pipeline**
   - Pipeline script from SCM: **Git**
   - Repository: `https://github.com/yourorg/hepl-payroll.git`
   - Script path: `Jenkinsfile`

4. **Configure Webhooks**
   - GitHub: Settings → Webhooks → Add webhook
   - URL: `http://jenkins:8080/github-webhook/`
   - Events: Push events, Pull requests

### Jenkins Pipeline Stages

1. **Checkout** - Clone repository
2. **Prepare Environment** - Verify tools
3. **Install Dependencies** - Composer & npm
4. **Build Assets** - Gulp build
5. **Code Quality - Linting** - PHP syntax check
6. **Code Quality - SonarQube** - Code analysis
7. **Unit Tests** - Run tests (if configured)
8. **Build Docker Image** - Create container
9. **Docker Security Scan** - Trivy vulnerability scan
10. **Push Docker Image** - Push to registry
11. **Deploy** - Deploy based on branch
12. **Post-Deploy Verification** - Health checks
13. **Cleanup & Archive** - Artifact archival

### Branch-based Deployment

```
develop  → Development (Port 8080)
staging  → Staging (Port 8081)
main     → Production (Port 80/443)
```

---

## SonarQube Analysis

### Setup SonarQube

```bash
# Run SonarQube with Docker
docker run -d \
  -p 9000:9000 \
  --name sonarqube \
  -e SONARQUBE_JDBC_URL=jdbc:postgresql://db:5432/sonar \
  -e SONARQUBE_JDBC_USERNAME=sonar \
  -e SONARQUBE_JDBC_PASSWORD=sonar \
  sonarqube:latest
```

### Configuration

1. **sonar-project.properties**
   ```properties
   sonar.projectKey=hepl-payroll
   sonar.projectName=HEPL Payroll
   sonar.sources=.
   sonar.exclusions=vendor/**,node_modules/**
   ```

2. **SonarQube Server**
   - URL: `http://sonarqube:9000`
   - Default credentials: `admin:admin`

3. **Generate Token**
   - Go to: User → Security → Generate Token
   - Use in Jenkins credential: `sonar-token`

### Manual SonarQube Analysis

```bash
# Install SonarScanner (if not using Jenkins)
wget https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-4.8.0.2856-linux.zip
unzip sonar-scanner-cli-4.8.0.2856-linux.zip
mv sonar-scanner-4.8.0.2856-linux sonar-scanner

# Run analysis
./sonar-scanner/bin/sonar-scanner \
  -Dsonar.projectKey=hepl-payroll \
  -Dsonar.sources=. \
  -Dsonar.host.url=http://sonarqube:9000 \
  -Dsonar.login=your_token
```

---

## Deployment Environments

### Development Deployment

```bash
# Using deployment script
./deploy.sh dev

# Or manually
docker-compose -f docker-compose.dev.yml up -d

# Connect to database
mysql -h localhost -u payroll_user -p hepl_payroll_dev
# Password: payroll_pass
```

**Access Points:**
- Application: http://localhost:8080
- Database: localhost:3306
- PHPMyAdmin: http://localhost:8888

### Staging Deployment

```bash
# Using deployment script
./deploy.sh staging

# Or manually
docker-compose -f docker-compose.staging.yml up -d
```

**Configuration:**
- Load `.env.staging` for environment variables
- Database: localhost:3307 (or configured host)
- Uses persistent volumes at `/data/payroll-staging/`

### Production Deployment

```bash
# Using deployment script (Linux only)
./deploy.sh prod

# Or manually
docker-compose -f docker-compose.prod.yml up -d
```

**Configuration:**
- Load `.env.prod` for environment variables
- Database: External MySQL server
- SSL/TLS: Nginx reverse proxy with Let's Encrypt
- Volumes: `/data/payroll-prod/`
- Logging: JSON file with rotation

**Important:**
- Never use environment variables in containers; use external .env files
- Always backup database before deploying to production
- Use HTTPS only in production
- Configure firewall rules

---

## Environment Configuration

### .env File Format

Create environment-specific files:

```bash
# Development
cat > .env.dev << EOF
CI_ENVIRONMENT=development
DATABASE_HOSTNAME=db
DATABASE_USERNAME=payroll_user
DATABASE_PASSWORD=payroll_pass
DATABASE_DATABASE=hepl_payroll_dev
base_url=http://localhost:8080/
EOF

# Staging
cat > .env.staging << EOF
CI_ENVIRONMENT=staging
DATABASE_HOSTNAME=staging-db.example.com
DATABASE_USERNAME=payroll_user
DATABASE_PASSWORD=$(openssl rand -base64 32)
DATABASE_DATABASE=hepl_payroll_staging
base_url=https://staging-payroll.example.com/
EOF

# Production
cat > .env.prod << EOF
CI_ENVIRONMENT=production
DATABASE_HOSTNAME=prod-db.example.com
DATABASE_USERNAME=payroll_user
DATABASE_PASSWORD=$(openssl rand -base64 32)
DATABASE_DATABASE=hepl_payroll
base_url=https://payroll.example.com/
EOF
```

**Do NOT commit `.env.*` files to Git!**

---

## CI/CD Pipeline Flow

```
┌─────────────────┐
│   Git Push      │
└────────┬────────┘
         │
         ▼
┌─────────────────────────────┐
│ 1. Checkout Code            │
└────────┬────────────────────┘
         │
         ▼
┌─────────────────────────────┐
│ 2. Install Dependencies     │
│    - Composer              │
│    - npm                   │
└────────┬────────────────────┘
         │
         ▼
┌─────────────────────────────┐
│ 3. Build & Code Quality     │
│    - Gulp build            │
│    - PHP lint              │
│    - SonarQube analysis    │
└────────┬────────────────────┘
         │
         ▼
┌─────────────────────────────┐
│ 4. Docker Build & Test      │
│    - Build image           │
│    - Security scan         │
│    - Push to registry      │
└────────┬────────────────────┘
         │
    ┌────┴────┬──────────┬──────────┐
    │          │          │          │
    ▼          ▼          ▼          ▼
develop   staging      main    (feature)
    │          │          │
    ▼          ▼          ▼
  Dev       Staging    Production
  8080      8081       80/443
    │          │          │
    └──────────┴──────────┘
         │
         ▼
┌─────────────────────────────┐
│ 5. Health Checks & Archive  │
│    - Verify deployment      │
│    - Save artifacts         │
└─────────────────────────────┘
```

---

## Monitoring & Logging

### View Logs

```bash
# Development
docker-compose -f docker-compose.dev.yml logs -f

# Specific service
docker-compose -f docker-compose.dev.yml logs -f web

# Last 100 lines
docker logs --tail 100 -f hepl-payroll-dev
```

### Check Container Health

```bash
# View health status
docker inspect --format='{{.State.Health.Status}}' hepl-payroll-dev

# View detailed health info
docker inspect hepl-payroll-dev | grep -A 10 Health
```

### Monitor Resources

```bash
# CPU, Memory, Network usage
docker stats hepl-payroll-dev

# View process list
docker-compose -f docker-compose.dev.yml top web
```

---

## Backup & Recovery

### Database Backup

```bash
# Development
docker-compose -f docker-compose.dev.yml exec db \
  mysqldump -u payroll_user -p hepl_payroll_dev \
  > backup_dev_$(date +%Y%m%d_%H%M%S).sql

# Production
docker-compose -f docker-compose.prod.yml exec db \
  mysqldump -u payroll_user -p hepl_payroll \
  > backup_prod_$(date +%Y%m%d_%H%M%S).sql
```

### Database Restore

```bash
# Restore backup
docker-compose -f docker-compose.dev.yml exec -T db \
  mysql -u payroll_user -p hepl_payroll_dev < backup_dev_20240715_120000.sql
```

### Volume Backup

```bash
# Backup volumes
docker run --rm -v payroll_mysql_data_dev:/data \
  -v $(pwd):/backup \
  alpine tar czf /backup/mysql_backup.tar.gz -C /data .

# Restore volumes
docker run --rm -v payroll_mysql_data_dev:/data \
  -v $(pwd):/backup \
  alpine tar xzf /backup/mysql_backup.tar.gz -C /data
```

---

## Troubleshooting

### Container Won't Start

```bash
# Check logs
docker logs hepl-payroll-dev

# Common issues:
# 1. Port already in use
netstat -an | grep 8080

# 2. Insufficient disk space
docker system df

# 3. Permission issues
docker-compose -f docker-compose.dev.yml logs | grep permission

# Solution: Remove and rebuild
docker-compose -f docker-compose.dev.yml down -v
docker-compose -f docker-compose.dev.yml up -d --build
```

### Database Connection Failed

```bash
# Check MySQL is running
docker-compose -f docker-compose.dev.yml ps

# Test connection from container
docker-compose -f docker-compose.dev.yml exec web \
  mysql -h db -u payroll_user -p hepl_payroll_dev -e "SELECT 1"

# Check network
docker network ls
docker network inspect payroll-network
```

### High Memory/CPU Usage

```bash
# Monitor resource usage
docker stats

# Limit resources in docker-compose.yml:
# services:
#   web:
#     deploy:
#       resources:
#         limits:
#           cpus: '2'
#           memory: 2G
```

### SonarQube Analysis Timeout

```bash
# Increase timeout in Jenkinsfile:
# sonar.qualitygate.timeout=600

# Or run manually with verbose output:
./sonar-scanner/bin/sonar-scanner -X
```

---

## Security Best Practices

1. **Secrets Management**
   - Use environment files (not in Docker)
   - Use Jenkins Credentials for sensitive data
   - Rotate tokens and passwords regularly

2. **Container Security**
   - Run as non-root user
   - Use read-only filesystems where possible
   - Scan images for vulnerabilities (Trivy)
   - Keep base images updated

3. **Database Security**
   - Use strong passwords
   - Restrict network access
   - Enable SSL for database connections
   - Regular backups

4. **Jenkins Security**
   - Enable authentication
   - Use HTTPS
   - Restrict job access
   - Enable audit logging

5. **Application Security**
   - Enable HTTPS in production
   - Use prepared statements
   - Validate all inputs
   - Run security headers

---

## Performance Optimization

### Docker Optimization

```bash
# Use multi-stage build
# Remove unnecessary layers
# Optimize image size

docker image ls # Check size
```

### Database Optimization

```bash
# Add indexes
# Optimize queries
# Use connection pooling
```

### Caching

```bash
# Use Docker build cache
docker build --cache-from hepl-payroll:latest .

# Cache dependencies
# Implement page caching in application
```

---

## Additional Resources

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Reference](https://docs.docker.com/compose/compose-file/)
- [Jenkins Documentation](https://www.jenkins.io/doc/)
- [SonarQube Documentation](https://docs.sonarqube.org/)
- [CodeIgniter Documentation](https://codeigniter.com/docs)
- [PHP Best Practices](https://www.php-fig.org/)

---

## Support & Contact

For issues or questions:
- Create GitHub issue
- Contact DevOps team
- Review Jenkins logs
- Check SonarQube dashboard

---

**Last Updated**: 2024-07-15
**Version**: 1.0.0
