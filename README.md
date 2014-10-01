Giic2
=====

---
**NOTE! THIS EXTENSION IS OUTDATED  AND WILL NOT BE MAINTAINED, FUNCTIONALITY IS AVAILABLE IN YII2-CORE SINCE 2.0.0-RC**
---

Running Yii2 Framework Gii Code Generators from command line

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist dmstr/yii2-gii-command "*"
```

Setup
-----

**Make sure the Gii module is available in your console configuration.**

```
$config['bootstrap'][] = 'gii';
$config['modules']['gii'] = 'yii\gii\Module';
```

The extension will register a `giic` command alias in the application bootstrap process, if Gii is available.


Usage
-----

Show available generators:

```
./yii help giic
```

**Note: giic is NOT generating and overwriting code files unless you use the option `--generate=1`**

### Create a controller

```
./yii giic/controller --template=default --controller=my-first-giic-controller
```

### Create a model

```
./yii giic/model --template=default --tableName=foo --modelClass=Foo
```

### Run a giiant batch

```
./yii giiant-batch \
  --tables=actor,address,category,city,country,customer,film,film_actor,film_category,film_text,inventory,language,payment,rental,staff,store \
  --modelNamespace=app\\models \
  --crudControllerNamespace=app\\controllers\\crud --crudViewPath=@app/views/crud
```

The above command will create models and CRUDs with relations for all given table names
using the [giiant](https://github.com/schmunk42/yii2-giiant) generators.


Known Limitations
-----------------

### Compatibility with Help command

```
./yii help giic/model
```

Will not show all available options, a workaround is to look at the generator attributes or run the command without any
parameters and review the *Attribute Errors*.

```
$ ./yii giic/model
Loading generator 'model'...

Attribute Errors
----------------
template: A code template must be selected.
tableName: Table Name cannot be blank.
modelClass: Model Class cannot be blank if table name does not end with asterisk.
```


Links
-----

- [Packagist](https://packagist.org/packages/dmstr/yii2-gii-command)
- [GitHub](https://github.com/dmstr/yii2-gii-command)
- [diemeisterei GmbH](http://diemeisterei.de)

### Related Extensions

- [giiant](https://github.com/schmunk42/yii2-giiant)
