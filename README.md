# SketchOver

## About Sketchover 
   Sketchover is a javascript drawing pad where you can draw anything and post your sketch on the main page. You can change the color, size of brush and change the color of background
	
## Link : 
[www.saurabhdaware.cf/webapps/SketchOver/](http://www.saurabhdaware.cf/webapps/SketchOver/)


## Working :

- The main javascript functions of the project are inside `/responsive-sketchpad.js` 
- when your cursor touches the canvas a javascript function is fired which draws a circle on that location
- When you click Save button canvas drawing is converted into an image and stored in folder `/Data/`
- On main page all the images from `/Data/` are retrieved back using PHP
