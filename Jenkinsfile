def gitUrl = "https://github.com/waycambas8/service-product.git"
def service = "service-product-app"
def serviceNginx = "service-product-nginx"

pipeline {
    agent any
    environment {
        GIT_CREDENTIALS = credentials('github-login-token')
    }
    stages {
        stage('Clone') {
            steps {
                script {
                    cleanWs()
                    checkout([$class: 'GitSCM', branches: [[name: 'main']], userRemoteConfigs: [[credentialsId: 'github-login-token', url: "${gitUrl}"]]])
                    echo "success step 1"
                }
            }
        }

        stage('SSH Client') {
            steps {
                sshagent(['ssh-app']) {
                    sh """
                        ssh -o StrictHostKeyChecking=no ec2-user@13.250.52.15 "
                            cd fazz && git pull origin main && sudo chmod -Rf 777 storage/
                            docker-compose -f .docker/compose-dev.yml run --rm app composer install
                            docker-compose -f .docker/compose-dev.yml run --rm app php artisan key:generate

                            docker rm -f ${service} ${serviceNginx}
                            docker-compose -f .docker/compose-dev.yml up -d --build
                        "
                    """
                }
                echo "success step 2"
            }
        }
    }
}
