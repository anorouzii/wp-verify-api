**Generate verification code**

`example.com/wp-json/wva/v1/email`

Email should be post in JSON format.

Example : 
`{
	"email" : "anorouziiii@gmail.com"
}`

**Check verification code** 

`example.com/wp-json/wva/v1/verify`

Email and verification code should be posted in JSON format. if the code is correct and the expire time is not reached, it will return `true` otherwise it's `false` then you can do whatever you want with the result like for OTP, Email Owner verification, and so on.

Example : 
`{
	"email" : "anorouziiii@gmail.com",
	"verify" : "53737"
}`