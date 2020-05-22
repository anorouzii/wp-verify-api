![WP Verify API](https://imagehost.imageupload.net/2020/05/22/banner-772x250.png)


This plugin generates a verification code via WordPress API and sends it to the specified email.
You can then check the code entered by the user with the API.


# Generate verification code

`example.com/wp-json/wva/v1/email`

Email should be post in JSON format.

**Example :** 
```
{ "email" : "anorouziiii@gmail.com" }
```

# Check verification code

`example.com/wp-json/wva/v1/verify`

Email and verification code should be posted in JSON format. if the code is correct and the expire time is not reached, it will return `true` otherwise it's `false` then you can do whatever you want with the result like for OTP, Email Owner verification, and so on.

**Example :** 
```
{"email" : "anorouziiii@gmail.com","verify" : "53737"}
```

# Screenshots

![Dashboard Screenshot](https://imagehost.imageupload.net/2020/05/22/screenshot-2.png)
![Email Screenshot](https://imagehost.imageupload.net/2020/05/22/screenshot-1.png)
