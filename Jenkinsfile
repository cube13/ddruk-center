#!groovy

import groovy.json.JsonOutput
import java.util.Optional
import hudson.tasks.test.AbstractTestResultAction
import hudson.model.Actionable
import hudson.tasks.junit.CaseResult

def speedUp = '--configure-on-demand --daemon --parallel'
def nebulaReleaseScope = (env.GIT_BRANCH == 'origin/master') ? '': "-Prelease.scope=patch"
def nebulaRelease = "-x prepare -x release snapshot ${nebulaReleaseScope}"
def gradleDefaultSwitches = "${speedUp} ${nebulaRelease}"
def gradleAdditionalTestTargets = "integrationTest"
def gradleAdditionalSwitches = "shadowJar"
def slackNotificationChannel = "general"
def author = ""
def message = ""
def testSummary = ""
def total = 0
def failed = 0
def skipped = 0
def bout = 0

def isResultGoodForPublishing = {->
return currentBuild.result == null
}

def getGitAuthor = {
def commit = sh(returnStdout: true, script: 'git rev-parse HEAD')
author = sh(returnStdout: true, script: "git --no-pager show -s --format='%an' ${commit}").trim()
}

def getLastCommitMessage = {
message = sh(returnStdout: true, script: 'git log -1 --pretty=%B').trim()
}

def buildOut = {
  bout = sh(returnStdout: true, script: 'la -al').trim()
  bout = bout +  sh(returnStdout: true, script: 'df -h').trim()
}

def populateGlobalVariables = {
getLastCommitMessage()
getGitAuthor()
}

def notifySlack(text, channel, attachments) {
  def slackURL = 'https://hooks.slack.com/services/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'
  def jenkinsIcon = 'https://wiki.jenkins-ci.org/download/attachments/2916393/logo.png'

  def payload = JsonOutput.toJson([
    text: text,
    channel: channel,
    username: "Deploy to ${env.JOB_NAME}",
    icon_url: jenkinsIcon,
  attachments: attachments
])

sh "curl -X POST --data-urlencode \'payload=${payload}\' ${slackURL}"
}





node {
  try {
stage('Checkout') {
checkout scm
populateGlobalVariables()
notifySlack("Start", slackNotificationChannel, [
[
//title: "${env.JOB_NAME}",
//title_link: "${env.BUILD_URL}"
author_name: "${author}",
fields:
[
title: "Last Commit",
value: "${message}",
short: false
]
]
])
}

  stage('Build') {

    populateGlobalVariables()
    def buildColor = currentBuild.result == null ? "good": "warning"
    def buildStatus = currentBuild.result == null ? "Success": currentBuild.result
    def jobName = "${env.JOB_NAME}"
    buildOut()

    // Strip the branch name out of the job name (ex: "Job Name/branch1" -> "Job Name")
//    jobName = jobName.getAt(0..(jobName.indexOf('/') - 1))

    if (currentBuild.result != null) {
      buildStatus = "Failed"


      buildColor = "danger"

      notifySlack("", slackNotificationChannel, [
      [
        title: "${jobName}, build #${env.BUILD_NUMBER}",
        title_link: "${env.BUILD_URL}",
        color: "${buildColor}",
        text: "${buildStatus}\n${author}",
        "mrkdwn_in": ["fields"],
        fields: [
        [
          title: "Branch",
          value: "${env.GIT_BRANCH}",
          short: true
        ],
        [
          title: "Last Commit",
          value: "${message}",
          short: false
        ]
        ]
      ],
      [
        title: "Failed Tests",
        color: "${buildColor}",
        text: "${failedTestsString}",
        "mrkdwn_in": ["text"],
      ]
      ])
    } else
    {
      notifySlack("Build", slackNotificationChannel, [
      [
        title: "${jobName}, build #${env.BUILD_NUMBER}",
        title_link: "${env.BUILD_URL}",
        color: "${buildColor}",
        text: "${buildStatus}\n${author}",
        "mrkdwn_in": ["fields"],
        fields: [
        [
          title: "Branch",
          value: "${env.GIT_BRANCH}",
          short: true
        ],
        [
          title: "Last Commit",
          value: "${message}",
          short: false
        ],
        [
                value: "```${bout}```"
        ]
        ]
      ]
      ])
    }
  }

  if (isResultGoodForPublishing()) {
    stage ('Publish') {
      echo "Publish"
      sh "rsync -rvae \"ssh -p2212 -i /home/deployer/.ssh/id_rsa\" --exclude .git --exclude .idea --delete ${WORKSPACE}/ deployer@138.68.59.63:/home/deployer/${env.JOB_NAME}/"
    }
def buildColor = currentBuild.result == null ? "good": "warning"
def buildStatus = currentBuild.result == null ? "Success": currentBuild.result

notifySlack("Publish", slackNotificationChannel, [
[
title: "${env.JOB_NAME}",
title_link: "${env.BUILD_URL}",
color: "${buildColor}",
author_name: "${author}",
text: "Publish ${env.JOB_NAME} ${buildStatus}",
]
])
  }

  stage ('Restart containers'){
        echo "Container restarted"
def buildColor = currentBuild.result == null ? "good": "warning"
def buildStatus = currentBuild.result == null ? "Success": currentBuild.result

notifySlack("Restart containers", slackNotificationChannel, [
[
title: "${env.JOB_NAME}",
title_link: "${env.BUILD_URL}",
color: "${buildColor}",
author_name: "${author}",
text: "Containers restarted on ${env.JOB_NAME} ${buildStatus}",
]
])
  }
} catch (hudson.AbortException ae) {
// I ignore aborted builds, but you're welcome to notify Slack here
} catch (e) {
  def buildStatus = "Failed"


notifySlack("", slackNotificationChannel, [
[
title: "${env.JOB_NAME}, build #${env.BUILD_NUMBER}",
title_link: "${env.BUILD_URL}",
color: "danger",
author_name: "${author}",
text: "${buildStatus}",
fields: [
[
title: "Error",
value: "${e}",
short: false
]
]
]
])

throw e
}
}