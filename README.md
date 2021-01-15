# Dronfield Club Application

This is a membership tracking application for Dronfield Swimming Club in the Group Software Development module using HTML, CSS, PHP, MySQL and JavaScript.

## How to Clone
`git clone https://github.com/b9035802/dronfield-club-app`

## Download Git for Windows
 [Git](https://git-scm.com/download/win)
## For Linux
`apt-get install git`
`emerge --ask dev-vcs/git`
`xbps-install git`
check your package repository

## Git Basics
 ``` sh 
 git init 
 // Set up a git repo, if not already configured
 
 git status
 // To check how the repository status has changed
 
 git add <untracked_files>
 // To add untracked files. Use wildcards (*.txt *.js etc.), if you want to add all files use git add .
 
 git commit -m "<message for describing what's changed>"
 
 git log 
 // Chek the history of changes in the repo 
 ```

## Add Remote Github Repo to Local Repo
To push it to the github server later you have to add the remote repository

 ``` sh
 git remote add <remote name Ex: origin> <remote_repository_url>
 ```
 
## Push To & Pull From The Remote Repo
``` sh
 git push -u origin master
 ```
 
'-u' option tells Git to remember the parameters for next time

## Diff
Checking what is different from the last commit

```
git diff HEAD
```

HEAD = our most recent commit pointer

Adding one more file
```
git add <unstaged_file> 
// To add it to stage

git diff --staged 
// To compare the repo and the stage

git reset <staged_file> 
// To take it out from stage

git checkout -- <filename> 
// UNDO 
```

## Branching
Creating a branch to work on a copy of the code without affecting the main/master branch

``` sh
git branch <branch_name>

git checkout <branch_name>
// Working on a new branch

git rm <filename>
// To remove files and stage the removal of the files

git commit -m "<messages>"

git checkout master
// Go back to master branch

git merge <another_branch>
// Merge the changes from other branch

git branch -d <another_branch>
// Delete the branch after merge

git push
```
