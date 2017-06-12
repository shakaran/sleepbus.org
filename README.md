*README being updated for new repo, bear with*

# sleepbus.org

Dev tasks and issues for [sleepbus.org](https://www.sleepbus.org) webite

# Getting up and running with the project

Want to check out the code and get the local dev environment running on your machine?

Start by [sending Leon an email](mailto:leon.stafford@mac.com) with your GitLab and GitHub usernames (creating them if need be).

You'll be notified once you have access. You can now assign yourself dev tasks/bugs you'd like to work on from this GitHub repo's [Issues page](https://github.com/leonstafford/sleepbus_org/issues).

## Local dev environment

Being able to run the sleepbus.org web application on your local computer is fairly simple. We currently use a couple of Docker containers - one for MySQL (mariadb) and one for Apache/PHP.

Once you've cloned the repo from GitLab:

`git clone git@gitlab.com:ljs/sleepbus.git`

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

There is a [project board](https://github.com/leonstafford/sleepbus_org/projects/1) on GitHub, populated from the dev tasks on [GitHub Issues](https://github.com/leonstafford/sleepbus_org/issues). Assign yourself to the task you want to work on (which has not other assignee yet) and move the card over the Doing column.

### Git branching

 - create new feature branch, based off master when you start development
 - keep it up to date by rebasing (`git fetch && pull --rebase master` or such)
 - ping @leonstafford on the GitHub Issue and move your card into the Code review column, either when you think it's complete, or want an early review.
 - when dev has passed code review, it will be merged into master or other deployment branch (things still a bit manual until codebase moved to GitHub)

## Minimal process

This doc provides a starting point for our collaboration and will never be set in stone. Feel free to suggest improvements!

## Communicating

Where possible, discussing directly on the Issue or Pull Request is great. For things that don't fit into those, there is [sleepbus Gitter chatroom](https://gitter.im/sleepbusorg/) for public discussion. Email for anything private.

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
