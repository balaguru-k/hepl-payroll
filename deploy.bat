@echo off
REM HEPL Payroll - Deployment Script for Windows
REM Usage: deploy.bat [dev|staging|prod]

setlocal enabledelayedexpansion

set ENVIRONMENT=%1
if "!ENVIRONMENT!"=="" set ENVIRONMENT=dev

echo.
echo ======================================
echo HEPL Payroll Deployment Script
echo ======================================
echo Environment: !ENVIRONMENT!
echo.

REM Validate environment
if "!ENVIRONMENT!"=="dev" (
    goto start_dev
) else if "!ENVIRONMENT!"=="staging" (
    goto start_staging
) else if "!ENVIRONMENT!"=="prod" (
    goto start_prod
) else (
    echo Invalid environment. Use: dev, staging, or prod
    exit /b 1
)

:start_dev
echo [1/6] Checking prerequisites...
where php >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: PHP is not installed
    exit /b 1
)

where composer >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Composer is not installed
    exit /b 1
)

where docker >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Docker is not installed
    exit /b 1
)

echo [2/6] Installing dependencies...
call composer install --optimize-autoloader
if %errorlevel% neq 0 goto error
call npm install
if %errorlevel% neq 0 goto error

echo [3/6] Building assets...
call npm run build
if %errorlevel% neq 0 goto error

echo [4/6] Building Docker image...
docker build -t hepl-payroll:dev -t hepl-payroll:latest .
if %errorlevel% neq 0 goto error

echo [5/6] Starting containers...
docker-compose -f docker-compose.dev.yml down
docker-compose -f docker-compose.dev.yml up -d
if %errorlevel% neq 0 goto error

echo [6/6] Health check...
timeout /t 5 /nobreak
curl -f http://localhost:8080 >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Application failed health check
    docker-compose -f docker-compose.dev.yml logs
    exit /b 1
)

echo.
echo ======================================
echo Development deployment successful!
echo ======================================
echo.
echo Access your application:
echo   Web: http://localhost:8080
echo   Database: localhost:3306
echo   PHPMyAdmin: http://localhost:8888
echo.
goto end

:start_staging
echo Staging deployment not configured for Windows batch.
echo Please use WSL or configure manually.
goto error

:start_prod
echo Production deployment not configured for Windows batch.
echo Please use Linux/WSL for production deployments.
goto error

:error
echo.
echo ERROR: Deployment failed!
exit /b 1

:end
exit /b 0
