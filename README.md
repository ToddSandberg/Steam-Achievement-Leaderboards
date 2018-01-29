# Steam-Achievement-Leaderboards

This website was my first attempt at coding with PHP and web API's. Steam is a piece of software owned by the company Valve that allows for quick and easy PC gaming. On this software users obtain virtual "achievements" as they play games and preform challenges. My goal was to provide an ordered list of these achievements to users by querying the Steam API and ordering it using PHP.

*steamppi.php* is the main source of code. This file queries Steam API and orders and prints the achievement names, descriptions, the amount of people who have obtained the achievement, and a picture of the achievement. The list can be order either by most achieved, or least achieved. Achievements from games the user owns are the only ones shown.

*index.php* is an example of how to implement steampi into a website.
