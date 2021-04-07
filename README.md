# PHP Crypto Website Visitor Counter

* This is a simple counter which saves the counter values on encrypted files on your server.
* Just specify the path to the file and the key and the script will do the rest.
* Empty files are the initial condition. So just create an empty file and start counting from 0.

## Why?

* If you have a simple website and don't want to create a database at all.
* If you have certain things you want to count but not everybody else should be able to see the current count.
* Perfect Privacy as no user data will be requested. So it can be a very simple website visitor counter

## Usage
The simplest way to include the counter into your website is to use a hidden iframe.

```HTML
<iframe src="visitor-counter.php" hidden></iframe>
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
Copyright(c) 2021 Jan Ehrlich

[MIT](https://choosealicense.com/licenses/mit/)
