<?php
/**
* Created by Todd Sandberg.
* Version 1/29/2018
*/
if (!empty($_GET['Steamid'])) {
	$api_key = "0D88376E7EBBD56B7F0385A095374450";
	$steamid = $_GET["Steamid"];
	//get all games a person owns
	$api_url1 =  "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=$api_key&steamid=$steamid&format=json&include_played_free_games";
	$json1 = json_decode(file_get_contents($api_url1), true);
	$temp = $json1["response"]["games"];
	$stuff = array();
	for($x=0;$x<count($temp);$x++)
	{
		$app =  $temp[$x]["appid"];
		//if game has achievements
		$api_urlhasach =  "http://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid=$app&format=json";
		$jsonhasach = json_decode(file_get_contents($api_urlhasach), true);
		if(count($jsonhasach["achievementpercentages"]["achievements"]) > 0 && $app != 50 && /*$app != 107900 <-- do this block certain games from showing up*/)
		{
			//get global stats for game
			$api_url3 =  "http://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid=$app&format=json";
			$json3 = json_decode(file_get_contents($api_url3), true);
			$temp3 = $json3["achievementpercentages"]["achievements"];
			//for each game, if it has achievements, get owned achievements
			$api_url2 =  "http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=$app&key=$api_key&steamid=$steamid";
			$json2 = json_decode(file_get_contents($api_url2), true);
			$temp2 = $json2["playerstats"]["achievements"];
			
			for($y=0;$y<count($temp2);$y++)
			{	
				//if not achieved
				if($temp2[$y]["achieved"] == 0)
				{
					for($c=0;$c<count($temp3);$c++)
					{
						//save achievement stats in array if it is the same achievement
						if($temp3[$c]["name"] == $temp2[$y]["apiname"])
						{
							$namo = $temp3[$c]["name"];
							$stuff[$namo . "$" . $app] = $temp3[$c]["percent"];
							
						}
					}
				}
			}
		}
	}
	//sort based on values
	if($_GET["order"] == lach)
		asort($stuff);
	else
		arsort($stuff);
	$rank = 1;
	for($c=0;$c<$_GET["amount"];$c++)
	{
		//take apart concatenated string
		$keys = array_keys($stuff);
		$curr_key = $keys[$c];
		$things = explode("$",$curr_key);
		//print_r($things);
		$name = $things[0];
		$app1 = $things[1];
		//get images for chievos
		$api_url4 =  "http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?key=$api_key&appid=$app1";
		$json4 = json_decode(file_get_contents($api_url4), true);
		$temp4 = $json4["game"]["availableGameStats"]["achievements"];
		//keep searching array until find achievement
		$d = 0;
		while($name != $temp4[$d]["name"])
		{
			$d++;
		}
		$image = $temp4[$d]["icon"];
		$imageData = base64_encode(file_get_contents($image));
		//print ranking
		echo $rank. ". ";
		$rank++;
		//print name
		echo $temp4[$d]["displayName"] . " from: " . $json4["game"]["gameName"] . "(" . $app1 . ")";
                /*if($json4["game"]["gameName"] == ""){
                echo $app1;
				}*/
echo "<br>";
		//print desc
		echo $temp4[$d]["description"] . "<br>";
		//print percent
		echo $stuff[$curr_key] . "% of people have it". "<br>";
		//print image
		echo '<img src="data:image/jpeg;base64,'.$imageData.'">' . "<br>";
		$check = 1;
	}
}
?>