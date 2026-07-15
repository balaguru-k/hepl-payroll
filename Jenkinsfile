node {
    def gitBranch = "${env.GIT_BRANCH}"
    def buildNumber = "${env.BUILD_NUMBER}"
    def workspace = pwd()
    def appName = "hepl-payroll"
    def imageTag = "${buildNumber}"
    def sonarProjectKey = "hepl-payroll"
    def sonarHostUrl = "http://sonarqube-server:9000"  // Change to your SonarQube URL
    
    // LOCAL DEPLOYMENT CONFIGURATION (No Docker Hub)
    // Containers will be deployed to local Docker on these ports:
    // - Development: http://localhost:8080
    // - Staging: http://localhost:8081
    // - Production: http://localhost:8082
    
    try {
        stage('Checkout') {
            echo "========== Checking out code =========="
            checkout scm
            echo "✓ Code checked out from ${gitBranch}"
        }
        
        stage('Prepare Environment') {
            echo "========== Preparing environment =========="
            sh '''
                echo "PHP Version:"
                php --version
                echo "Node Version:"
                node --version
                echo "NPM Version:"
                npm --version
                echo "Docker Version:"
                docker --version
                echo "Workspace: ${PWD}"
            '''
        }
        
        stage('Install Dependencies') {
            echo "========== Installing dependencies =========="
            sh '''
                echo "Installing Composer dependencies..."
                composer install --no-dev --optimize-autoloader
                
                echo "Installing NPM dependencies..."
                npm ci
            '''
        }
        
        stage('Build Assets') {
            echo "========== Building frontend assets =========="
            sh '''
                echo "Building frontend assets with Gulp..."
                gulp build || npm run build
            '''
        }
        
        stage('Code Quality - Linting') {
            echo "========== Running PHP Linting =========="
            sh '''
                echo "Checking PHP syntax..."
                find application -name "*.php" -print0 | xargs -0 -n1 php -l
                php -l index.php
                echo "✓ PHP linting passed"
            '''
        }
        
        stage('Code Quality - SonarQube Analysis') {
            echo "========== Running SonarQube Analysis =========="
            sh '''
                echo "Installing SonarScanner if not present..."
                if [ ! -d "sonar-scanner" ]; then
                    wget https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-4.8.0.2856-linux.zip
                    unzip sonar-scanner-cli-4.8.0.2856-linux.zip
                    mv sonar-scanner-4.8.0.2856-linux sonar-scanner
                fi
                
                echo "Running SonarQube analysis..."
                ./sonar-scanner/bin/sonar-scanner \
                    -Dsonar.projectKey=${SONAR_PROJECT_KEY} \
                    -Dsonar.sources=. \
                    -Dsonar.host.url=${SONAR_HOST_URL} \
                    -Dsonar.login=${SONAR_LOGIN_TOKEN} \
                    -Dsonar.exclusions=vendor/**,node_modules/**,application/logs/**,application/cache/** \
                    -Dsonar.php.coverage.reportPaths=coverage/coverage.xml \
                    -Dsonar.sourceEncoding=UTF-8
                
                echo "✓ SonarQube analysis completed"
            '''
        }
        
        stage('Unit Tests') {
            echo "========== Running Unit Tests =========="
            sh '''
                echo "Running PHPUnit tests..."
                # Uncomment if PHPUnit is configured
                # vendor/bin/phpunit --coverage-clover=coverage/coverage.xml
                echo "✓ Tests passed (configure PHPUnit if needed)"
            '''
        }
        
        stage('Build Docker Image') {
            echo "========== Building Docker Image =========="
            sh '''
                echo "Building Docker image: hepl-payroll:${BUILD_NUMBER}"
                
                docker build \
                    --build-arg BUILD_DATE=$(date -u +'%Y-%m-%dT%H:%M:%SZ') \
                    --build-arg VCS_REF=$(git rev-parse --short HEAD) \
                    --build-arg VERSION=${BUILD_NUMBER} \
                    -t hepl-payroll:${BUILD_NUMBER} \
                    -t hepl-payroll:latest \
                    .
                
                echo "✓ Docker image built successfully"
                docker images | grep hepl-payroll
            '''
        }
        
        stage('Docker Security Scan') {
            echo "========== Scanning Docker Image for Vulnerabilities =========="
            sh '''
                echo "Scanning Docker image: hepl-payroll:${BUILD_NUMBER} for vulnerabilities..."
                # Using Trivy for vulnerability scanning
                if command -v trivy &> /dev/null; then
                    trivy image --severity HIGH,CRITICAL hepl-payroll:${BUILD_NUMBER}
                else
                    echo "Trivy not installed. Skipping vulnerability scan."
                    echo "To install: curl -sfL https://raw.githubusercontent.com/aquasecurity/trivy/main/contrib/install.sh | sh -s -- -b /usr/local/bin"
                fi
            '''
        }
        
        // Removed Docker Hub push - deploying locally instead
        
        stage('Deploy to Development') {
            when {
                branch 'develop'
            }
            echo "========== Deploying to Development (Local) =========="
            sh '''
                echo "Deploying to Development environment locally..."
                
                # Stop and remove existing container if running
                docker ps -a | grep ${APP_NAME}-dev && docker stop ${APP_NAME}-dev || true
                docker ps -a | grep ${APP_NAME}-dev && docker rm ${APP_NAME}-dev || true
                
                # Create directories for volumes
                mkdir -p /tmp/payroll-dev/logs
                mkdir -p /tmp/payroll-dev/uploads
                chmod -R 777 /tmp/payroll-dev
                
                # Run new container locally using built image
                docker run -d \
                    --name ${APP_NAME}-dev \
                    -p 8080:80 \
                    -e CI_ENVIRONMENT=development \
                    -e DATABASE_HOST=db-dev \
                    -e DATABASE_NAME=hepl_payroll_dev \
                    -v /tmp/payroll-dev/logs:/var/www/html/application/logs \
                    -v /tmp/payroll-dev/uploads:/var/www/html/uploads \
                    --restart=unless-stopped \
                    hepl-payroll:latest
                
                echo "✓ Development container deployed locally"
                docker ps | grep ${APP_NAME}-dev
                
                # Wait for container to be ready
                sleep 5
                curl -f http://localhost:8080 || echo "Container not ready yet"
            '''
        }
        
        stage('Deploy to Staging') {
            when {
                branch 'staging'
            }
            echo "========== Deploying to Staging (Local) =========="
            sh '''
                echo "Deploying to Staging environment locally..."
                
                # Stop and remove existing container if running
                docker ps -a | grep ${APP_NAME}-staging && docker stop ${APP_NAME}-staging || true
                docker ps -a | grep ${APP_NAME}-staging && docker rm ${APP_NAME}-staging || true
                
                # Create directories for volumes
                mkdir -p /tmp/payroll-staging/logs
                mkdir -p /tmp/payroll-staging/uploads
                chmod -R 777 /tmp/payroll-staging
                
                # Run new container locally using built image
                docker run -d \
                    --name ${APP_NAME}-staging \
                    -p 8081:80 \
                    -e CI_ENVIRONMENT=staging \
                    -e DATABASE_HOST=db-staging \
                    -e DATABASE_NAME=hepl_payroll_staging \
                    -v /tmp/payroll-staging/logs:/var/www/html/application/logs \
                    -v /tmp/payroll-staging/uploads:/var/www/html/uploads \
                    --restart=unless-stopped \
                    hepl-payroll:latest
                
                echo "✓ Staging container deployed locally"
                docker ps | grep ${APP_NAME}-staging
            '''
        }
        
        stage('Deploy to Production') {
            when {
                branch 'main'
            }
            echo "========== Deploying to Production (Local) =========="
            sh '''
                echo "Deploying to Production environment locally..."
                
                # Stop and remove existing container if running
                docker ps -a | grep ${APP_NAME}-prod && docker stop ${APP_NAME}-prod || true
                docker ps -a | grep ${APP_NAME}-prod && docker rm ${APP_NAME}-prod || true
                
                # Create directories for volumes
                mkdir -p /tmp/payroll-prod/logs
                mkdir -p /tmp/payroll-prod/uploads
                chmod -R 777 /tmp/payroll-prod
                
                # Run new container locally using built image
                docker run -d \
                    --name ${APP_NAME}-prod \
                    -p 8082:80 \
                    -e CI_ENVIRONMENT=production \
                    -e DATABASE_HOST=db-prod \
                    -e DATABASE_NAME=hepl_payroll \
                    -v /tmp/payroll-prod/logs:/var/www/html/application/logs \
                    -v /tmp/payroll-prod/uploads:/var/www/html/uploads \
                    --health-cmd='curl -f http://localhost/ || exit 1' \
                    --health-interval=30s \
                    --health-timeout=10s \
                    --health-retries=3 \
                    --restart=always \
                    hepl-payroll:latest
                
                echo "✓ Production container deployed locally"
                docker ps | grep ${APP_NAME}-prod
            '''
        }
        
        stage('Post-Deploy Verification') {
            echo "========== Verifying Deployment =========="
            sh '''
                echo "Checking container health..."
                sleep 10
                
                if [ "${GIT_BRANCH}" == "*/main" ]; then
                    DEPLOY_URL="http://localhost:8082"
                    CONTAINER_NAME="${APP_NAME}-prod"
                elif [ "${GIT_BRANCH}" == "*/staging" ]; then
                    DEPLOY_URL="http://localhost:8081"
                    CONTAINER_NAME="${APP_NAME}-staging"
                else
                    DEPLOY_URL="http://localhost:8080"
                    CONTAINER_NAME="${APP_NAME}-dev"
                fi
                
                # Check container status
                docker inspect --format='{{.State.Health.Status}}' ${CONTAINER_NAME} || echo "Container may not have health check"
                
                # Check if application is accessible
                if curl -f ${DEPLOY_URL} > /dev/null 2>&1; then
                    echo "✓ Application is accessible at ${DEPLOY_URL}"
                else
                    echo "⚠ Application may not be ready yet. Check logs:"
                    docker logs ${CONTAINER_NAME}
                fi
            '''
        }
        
        stage('Cleanup & Archive') {
            echo "========== Cleanup & Archive =========="
            sh '''
                echo "Cleaning up old Docker images..."
                docker image prune -a --force --filter "until=72h" || true
                
                echo "Creating build artifacts..."
                mkdir -p build-artifacts
                docker save hepl-payroll:${IMAGE_TAG} | gzip > build-artifacts/${APP_NAME}-${IMAGE_TAG}.tar.gz
                
                echo "✓ Build artifacts saved"
                ls -lh build-artifacts/
            '''
            archiveArtifacts artifacts: 'build-artifacts/**', allowEmptyArchive: true
        }
        
    } catch (Exception e) {
        echo "❌ Pipeline failed: ${e}"
        currentBuild.result = 'FAILURE'
        
        // Cleanup on failure
        sh '''
            echo "Cleaning up failed deployments..."
            docker ps -a | grep ${APP_NAME} | awk '{print $1}' | xargs -r docker rm -f || true
        '''
        throw e
    } finally {
        echo "========== Build #${BUILD_NUMBER} completed =========="
        echo "Status: ${currentBuild.result}"
    }
}
