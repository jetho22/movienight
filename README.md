# MovieNight

Git workflow for group 12

### Branching
Before we start to work on a new feature (user story), we should pull the latest changes from the remote DAM branch, and create a new branch for the feature.

Switch to the main branch, and pull the latest changes in to your local DAM branch
```
git checkout main
git pull
```

Create a new branch from main:

```
git checkout -b <feature_branch_name>
```

Now you can go ahead and work on your feature.
When it's time to push your changes, go through the following steps:

```
git add .
git commit -m "fancy feature message"
git checkout <feature_branch_name>
git merge <feature_branch_name>
git push
```

You should now see the changes reflected on the remote branch. To push directly to main branch from your feature branch, you can do the following:
```
git add .
git commit -m "fancy message"
git push origin <feature_branch_name>
```

### Pull
To pull changes from the remote branch, do the following:

```
git pull origin <feature_branch_name>
```

To merge your feature branch with main:
```
git checkout main
git merge <feature_branch_name>
```

Or the other way around
```
git checkout <feature_branch_name>
git merge main
```
