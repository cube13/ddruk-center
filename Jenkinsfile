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
//def testSummary = ""
def publishOut = ""
def restartOut = ""
def buildOut = ""

String[] nodes = [ "157.230.31.117","157.230.100.114" ]



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

def build(node) {
out = sh(returnStdout: true, script: "ssh -p2212 -i /home/deployer/.ssh/id_rsa deployer@${node} \"ls -al\"").trim()
out = out + " \n" +  sh(returnStdout: true, script: "ssh -p2212 -i /home/deployer/.ssh/id_rsa deployer@${node} \"df -h\"").trim()
return out
}
def publish(node) {
out = sh(returnStdout: true, script: "rsync -rvae \"ssh -p2212 -i /home/deployer/.ssh/id_rsa\" --exclude .git --exclude .idea --delete ${WORKSPACE}/ deployer@${node}:/home/deployer/${env.JOB_NAME}/").trim()
return out
}

def publishParallel = [:]
nodes.each {
def stepName = "running ${it}"
publishParallel[stepName] = { ->
publishOut = publishOut + " \n" +publish("${it}")
}
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

notifySlack("Build started", slackNotificationChannel, [
[
title: "${jobName}, build #${env.BUILD_NUMBER}",
title_link: "${env.BUILD_URL}",
color: "${buildColor}",
text: "*Last Commit*\n${message}"
]
])

buildOut=build(app02)


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
text: "${buildStatus}\n",
"mrkdwn_in": ["fields"],

]
])
} else
{
notifySlack("Build", slackNotificationChannel, [
[
color: "${buildColor}",
text: "```${buildOut}```\n${buildStatus}"
]
])
}
}

if (isResultGoodForPublishing()) {
  stage ('Publish') {
    echo "Publish"
    parallel publishParallel

    def buildColor = currentBuild.result == null ? "good": "warning"
    def buildStatus = currentBuild.result == null ? "Success": currentBuild.result


    notifySlack("Publish", slackNotificationChannel, [
    [
      color: "${buildColor}",
      text: "${buildStatus}\n```${publishOut}```",
    ]
    ])

  }
}

stage ('Restart containers'){
echo "Container restarted"
def buildColor = currentBuild.result == null ? "good": "warning"
def buildStatus = currentBuild.result == null ? "Success": currentBuild.result

notifySlack("Restart containers", slackNotificationChannel, [
[
color: "${buildColor}",
text: "```${restartOut}```\n${buildStatus}\n",
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