# Theme for Vorwerkstift Artist house in Hamburg

## Introduction

Made from the underscore theme. The theme is designed and developed by Georgios Plastok and Floriane Grosset

## Required

### Server side

Laragon

### Package manager

Node
Composer

### How to run Sass

Watch mode: any changes to a scss file will compile the main.css file

```cmd
npm run watch
```

### Plugins for VS code

#### Simple Auto Reload

Enables to reload automatically the page in chrome browser

##### Installation (Windows)

1. Right click on Chrome icon
2. Right click on Google Chrome
3. Properties
4. Shortcut tab
5. Target add `google-chrome --remote-debugging-port=9222` after application path
6. Make sure to reload the browser once set

##### How to run Auto Reload

1. CTRL + SHIFT + P (Command palette)
2. Select Auto-reload: Select tab
3. Select Browser tab to reload

### Useful GIT commands

```cmd
git pull
```

retrieve latest changes

```cmd
git checkout -b <feature/xxxx.xxx>
```

create a new branch and checkout to it

```cmd
git stage
```

```cmd
git commit -m '<custom message>'
```

```cmd
git push
```

sent to remote the commited work

```cmd
git checkout <oldname>
git branch -m <newname>
```

## To do:

- linter on save?
- beautifier ?
