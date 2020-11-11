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
