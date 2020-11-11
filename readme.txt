/** How we ignore files and folders using .gitignore **/

If you want to ignore the whole content of a directory except one file inside it, you could write a pair of rules for each directory in the file path. 
Example: .gitignore to ignore the xyz folder except from xyz/abc/test.xml

xyz/*
!xyz/abc
xyz/abc/*
!xyz/abc/test.xml

Note that if you simply had written above as following:

xyz/*
!xyz/abc/test.xml

It wouldn't work because the intermediary abc folder would not exist to Git, so test.xml could not find a place in which to exist.

To have a better understanding, please look/observe .gitignore file.


/** How we ignore .gitignore file itself **/

The .gitignore file's purpose is to prevent everyone who collaborates on a project from accidentally committing some common files in a project, such as generated cache files. Therefore we should not ignore .gitignore, since it's supposed to be included in the repository.
If we want to ignore .gitignore in just one repository but want to avoid the same in other repositories; just add .gitignore in .git/info/exclude file of your current repository at your local machine then your exclude file would look like something as following:

# git ls-files --others --exclude-from=.git/info/exclude
# Lines that start with '#' are comments.
# For a project mostly in C, the following would be a good set of
# exclude patterns (uncomment them if you want to use them):
# *.[oa]
.gitignore
# *~

Note: But remember, .gitignore file would be ignored using the above way if and only if .gitignore file is not already part of git-repository. Otherwise you would need to remove it from git repository first then you can use above method to ignore .gitignore file itself.
