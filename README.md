# Annotated Container Demo

This library is a simple, CLI-powered Todo list created with Annotated Container, Doctrine, and Symfony Console. This 
library is meant to showcase the following aspects of [Annotated Container](https://github.com/cspray/annotated-container).

- How you can use Annotated Container bootstrapping to easily create your Container.
- How to configure services, include third-party interfaces, using Annotated Container.
- How to integrate a service like Doctrine using a type-safe configuration.
- How to use factories to create services and not rely on the Container to act as a service locator.
- How you can use custom, semantic attributes to define implementations the Container should be responsible for.
- How you can automatically wire-up "complex" objects, like automatically including Console commands with no extra configuration or bootstrap changes.
- An example of the logs that are output by Annotated Container

## Installation

Unlike most packages I maintain this library is _not_ meant to be installed via Composer. You should clone this repo and run it directly.

```shell
cd /your/workspace
git clone https://github.com/cspray/annotated-container-doctrine-demo.git
cd annotated-container-doctrine-demo && composer install
```

## Setup

Before you can start using the tool you should make sure the database and schema are created. This is accomplished by 
using Doctrine's schema migration tool. Execute the following commands from your repo's root:

```shell
./bin/doctrine orm:schema-tool:create
PROFILES=default,prod ./bin/doctrine orm:schema-tool:create
```

By default, if you don't provide any profiles this tool will assume that `default` and `dev` are the active profiles. 
The first command creates the "dev" database and the second command creates the "prod" database. To confirm this make 
sure the 2 files exist, `data/dev.sqlite` and `data/prod.sqlite`.

At this point you're ready to start creating todo items!

## Usage Guide

This tool allows you to perform a variety of actions you'd normally see when interacting with a database:

- The creation of new todo items.
- Listing out todo items and their status.
- Marking a todo item as done.

In a real app you'd want to be able to edit the todo's status in a lot of ways. Since this is a demo app we'll leave the 
updating of a todo's status to something other than done as an exercise for the reader.

> All the commands below work on the "dev" database by default. Prefix each command with `PROFILES=default,prod` to 
> work with the "prod" database!

### Create Todo

First thing you'll need to create a todo. This can be accomplished by using the `./bin/todo-demo` CLI tool. This is a 
Symfony Console application, so it includes all the "bells and whistles" you might expect in a robust console application.

```shell
./bin/todo-demo create-todo "What I need to get done"
# Successfully created todo!
```

Repeat this for however many things you want to do.

### List Todos

After you've created some items you'll want to look over them, so you can remember what you need to get done.

```shell
./bin/todo-demo list-todo
```

This command will list out the created Todo items in a table format.

### Finish Todo

At some point you'll get one of your todo's done, you should mark it done in your list so you remember you did it! And 
for that sweet, sweet dopamine hit. You'll need to provide the ID of the Todo. You can get IDs with the `list-todo` 
command.

```shell
./bin/todo-demo finish-todo <TODO-ID>
# Successfully marked Todo done!
```

## Considerations

This app is not meant to be a truly production-ready app. It is missing tests, would need to provide more functionality, 
and made some design decisions intentionally to showcase Annotated Container functionality. What's of real import here 
isn't what you can do with the app but the perceived "cleanliness" of the code. Please give it a review! Of particular 
import:

- No YAML or JSON configurations. The configuration that is present is minimal and primarily points to the code that has Attributes on it.
- Doctrine `EntityManagerInterface` is created through a Factory that takes in a type-safe Configuration object.
- A Doctrine Repository is created and shared with the Container, but we use a custom Attribute, `#[Repository]` to mark it.
- Similarly, Symfony Console Commands are created and shared with the container using `#[CliCommand]`.
- The `data/logs/annotated-container.log` file details extensive information about the compilation and Container creation process.