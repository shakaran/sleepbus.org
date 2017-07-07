[![CircleCI](https://circleci.com/gh/sleepbusorg/sleepbus.org/tree/master.svg?style=svg)](https://circleci.com/gh/sleepbusorg/sleepbus.org/tree/master)

# sleepbus.org

Source code, development tasks and issue tracker for [sleepbus.org](https://www.sleepbus.org) non-profit organisation, helping to provide safe sleeps for those living rough.

# Getting up and running with the project

Want to check out the code and get the local dev environment running on your machine?

No problem, everything's here that you need. As the source code is public domain, you can clone or [download the latest snapshot of our master branch](https://github.com/sleepbusorg/sleepbus.org/archive/master.zipl) and follow the instructions below to get it running. 

If you're wanting to join the volunteer team of developers and testers, please send en email to [leonstafford@protonmail.com](mailto:leonstafford@protonmail.com) with your GitHub username, or chat with him on [Gitter](https://gitter.im/leonstafford) and he'll add you to the team in GitHub.

Continue reading below and if you need help, [create an issue](https://github.com/sleepbusorg/sleepbus.org/issues), one of the devs will respond to you.

## Local dev environment

Being able to run the sleepbus.org web application on your local computer is fairly simple. We currently use a couple of Docker containers - one for MySQL (mariadb) and one for Apache/PHP.

Once you've cloned this repo from GitHub:

`git clone git@github.com:sleepbusorg/sleepbus.org.git`

You can run the provisioning script:

`./destroy_rebuild.sh`

This may ask for your `sudo` password and complain if you don't have the depencies installed.

The first run will take a while, as it downloads the base Docker images.

If successful, you should be able to see the sleepbus website in all it's glory at [http://localhost:8080](http://localhost:8080). If not, don't worry, just contact Leon or even create an issue here in the repo and another dev may be able to help you troubleshoot things.

*Note: if something does not seem right, there may have been a change in the provisioning script to support other changes. Running `./destroy_rebuild.sh` again will give you the latest expected environment*

### Local email deliverability

As part of provisioning, we also spin up a [Mailcatcher](https://github.com/sj26/mailcatcher) container. This should be accessible at [http://localhost:1080](http://localhost:1080) and will show you all `smtp` delivered emails to any target address.

### phpMyAdmin

Whilst being able to shell into the mariadb container as described above, you can also use phpMyAdmin as web GUI for administering the local database. This is accessible at [http://localhost:3008](http://localhost:3008), using the username/password `root / banana`.

### Shelling into Docker containers

To get into the running container to view logs or modify the environment:

 - `sudo docker ps # get container name`
 - `sudo docker exec -it sleepbusweb bash`

## Development flow

[GitHub Issues](https://github.com/leonstafford/sleepbusorg/sleepbus.org/issues) contain our development tasks and bugs to work on. Assign yourself to the task you want to work on (which has no other assignee yet).

### Git branching

 - create new feature branch, based off master when you start development
 - keep it up to date by rebasing (`git fetch && pull --rebase master` or such)
 - either when you want early feedback or when you think the task is complete, create a pull request in GitHub
 - when dev has passed code review, it will be merged into master or other deployment branch

## Minimal process

This doc provides a starting point for our collaboration and will never be set in stone. Feel free to suggest improvements!

## Communicating

Where possible, discussing directly on the Issue or Pull Request is great. For things that don't fit into those, there is [sleepbus Gitter chatroom](https://gitter.im/sleepbusorg/) for public discussion. Email for anything private.

## Reporting issues

Access the build information for the environment at `/version.txt`. Use this when reporting the issue you have encountered.

*TODO: add Issue template in GitHub*

## Style guide/linting

Currently nothing in place - offer suggestions.

### Dependencies

Just Docker, really. You may also need to start the Docker daemon, depending on your OS and method of installing Docker. 

### The sleepbus domain

In order to develop better solutions, we should have an understanding of the domain we are working in.

Sleepbus is a non-profit organisation, currently operating in Australia only. Its aim is to provide sleeping quarters for homeless people. The website acts as a tool for marketing and fundraising, also for users to participate in fundraising activities and track their contributions.

**Users** are people who have signed up to the website. Being registered allows them to create campaigns, see a history of their donations.

**Donors** are people who have made donations. They may be users or prefer to be anonymous donors.

**Donations** are represent the monetary contributions people submit. They can be allocated to a campaign, be one-off sleepbus donations or be a recurring donation.

**Campaigns** are created by users and have a one to many relationship with donations.

**Projects** are what currently represents each bus, but could be used for any other sleepbus project. They have a one to many relationship with Campaigns. 

Need clarification of function/necessity:

 - blogs
 - products
 - supports
 - testimonials
 - news

*some of the above, along with other tables in the database can likely be removed from the project*

### Thanks to volunteer contributors!

These people have helped in small and large ways to bring the purpose of sleepbus to its audience. Many thanks to you all and I hope this list is soon too large for this page!

[@guitarino](https://github.com/guitarino), [@bakersemail](https://github.com/bakersemail)

### Thanks to our service donators!

These companies have offered their services for free to our open source/non-profit project.

 - [BrowserStack](https://www.browserstack.com)

![BrowserStack Logo](https://raw.githubusercontent.com/sleepbusorg/sleepbus.org/master/src/images/browserstack_logo.gif)

BrowserStack is an awesome service that sleepbus's developers have used on other big projects in the past. It allows you to run automated tests against a myriad of modern browser/device combinations, even behind a private network. Live test sessions can also be performed in the browser, when you want to quickly check how a page looks in a certain device/browser/resolution combination. Thanks for your support on this project!


