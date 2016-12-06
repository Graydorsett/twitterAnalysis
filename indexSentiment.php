<!-- ////////////// HTML ///////////////// -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Analysis</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="c3.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div class="header">
        <h1>Twitter Analysis</h1>
    </div>
    <div class="container page">
        <div class="inputBar">
            <form action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
            <input class="search" type="text" name="twitterHandle"><br>
            </form>
        </div>
        <div class="name">
            <h2>@<?php echo $_POST["twitterHandle"]?></h2>
            <div class="line"></div>
        </div>
        <div class="results" style="padding-left: 0px">
            <div class="row">
                <div class="col-sm-4">
                    <div class="data">
                        <h3>Sentiment</h3>
                        <div class="line">
                            <div id="sentiment"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="data">
                        <h3>Persona</h3>
                        <div class="line">
                            <h2 class="persona" id="persona"></h2>
                            <br>
                            <h4 id="pBody"></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="data">
                        <h3>Personality</h3>
                        <div class="line">
                            <div id="">
                              <canvas id="personality" height="140px"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="data">
                        <h3>Politics</h3>
                        <div class="line">
                            <div id=""></div>
                            <canvas id="politics" height="140px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="data">
                        <h3>Emotion</h3>
                        <div class="line">
                            <div id=""></div>
                            <canvas id="emotion" height="110px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="data">
                        <h3>Engagement</h3>
                        <div class="line">
                            <div id="engagement"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="data" height="700px">
                        <h3>Topics</h3>
                        <div class="line">
                        </div>
                        <div id="topics"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="data" height="700px">
                        <h3>Keywords</h3>
                        <div class="line">
                        </div>
                        <div id="keywords"></div>
                    </div>
                </div>
            </div>
<!--
            <div class="row">
                <div class="col-xs-6">
                    <div class="data">
                        <h3>People</h3>
                        <div class="line">
                            <div id=""></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="data">
                        <h3>Organizations</h3>
                        <div class="line">
                            <div id=""></div>
                        </div>
                    </div>
                </div>
            </div>
-->
        </div>
    </div>


<!--    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!--    C3/D3-->
    <script src="d3.min.js" charset="utf-8"></script>
<script src="c3.min.js"></script>


    <script src="scripts.js"></script>

</body>
</html>



<!-- ////////////////// PHP /////////////////// -->
<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "16192753-McJ0xYDzEBeEuCnaK5V1tf54fuTqkZ8LoggPZXN1s",
    'oauth_access_token_secret' => "hyRycMMVbWlNgrDEyQAjfKUZtEnzRIgnZEbus8amLTYgr",
    'consumer_key' => "h9nWpPMflUYJWVHprs9GXDws1",
    'consumer_secret' => "vTxDeC5qnY6rU5B0nH06v6tN7erkNHgMyysAjkwrPwTWxfX9cW"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock',
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
  // $twitter = new TwitterAPIExchange($settings);
  // echo $twitter->buildOauth($url, $requestMethod)
  //              ->setPostfields($postfields)
  //              ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
// echo "just before";
$twitterHandle = $_POST["twitterHandle"];

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=' . $twitterHandle . '&count=200';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);




$tweetData = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc=TRUE);

$tweets;
foreach($tweetData as $index => $items){
      // echo "inside loop";
      // echo '<div class="twitter-tweet"> <a href="http://twitter.com/' . $userArray['screen_name'] . '"><img src="' . $userArray['profile_image_url'] . '"></a><a href="http://twitter.com/' . $userArray['screen_name'] . '">' . $userArray['name'] . '</a><br/>' . $items['text'];
      // echo '<br/>' . $items['created_at'];
      // echo '</div>';

      $tweet = $items['text'];
      $tweets .= $tweet;
};
?>



<!-- ///////////////////////////// JavaScript ////////////////////////// -->

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


<!-- ////////////// Sentiment Analysis /////////////// -->
<script>
//////// Create js variable from php tweets ////////
  var tweets = <?php echo json_encode($tweets); ?>;


////////// Run Analysis ///////////
//////////PERSONALITY: Extraversion, Openness, Agreeableness, Conscientiousness

    $.post(
    'https://apiv2.indico.io/personality',
    JSON.stringify({
    'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
    'data': tweets
    })
  ).then(function(res) {
    console.log("PERSONALITY" + res);
    displayPersonality(res);
  });


   ////////PERSONAS: 16 Myers Briggs
    $.post(
    'https://apiv2.indico.io/personality',
    JSON.stringify({
    'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
    'data': tweets,
    'persona' : true,
    'top_n': 1,
    })
  ).then(function(res) {
    console.log("PERSONAS" + res);
    displayPersona(res);
  });

    //////EMOTION: Anger, Joy, fear, sadness, surprise
    $.post(
    'https://apiv2.indico.io/emotion',
    JSON.stringify({
    'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
    'data': tweets
    })
  ).then(function(res) { console.log("EMOTIONS" + res); displayEmotion(res)});

  ////// SENITMENT : Pos or Neg 0-1.0
    $.post(
    'https://apiv2.indico.io/sentiment',
    JSON.stringify({
      'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
      'data': tweets
    })
  ).then(function(res) { console.log("SENTIMENT" + res); displaySentiment(res)});

//////// TOPIC TAGS
    $.post(
    'https://apiv2.indico.io/texttags',
    JSON.stringify({
      'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
      'data': tweets,
      'top_n': 10
    })
  ).then(function(res) { console.log("TOPICS" + res); displayTopics(res)});

/////// POLITICAL : Libertarian, Green, Liberal, Conservative
      $.post(
    'https://apiv2.indico.io/political',
    JSON.stringify({
      'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
      'data': tweets
    })
  ).then(function(res) { console.log("POLITICS" + res); displayPolitical(res)});

////// KEYWORDS
    $.post(
      'https://apiv2.indico.io/keywords?version=2',
      JSON.stringify({
        'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
        'data': tweets,
        'top_n': 10
      })
    ).then(function(res) { console.log("KEYWORDS" + res); displayKeywords(res)});

///////// PEOPLE
      $.post(
        'https://apiv2.indico.io/people',
        JSON.stringify({
          'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
          'data': tweets,
          'threshold': 0.75
        })
      ).then(function(res) { console.log("PEOPLE" + res); displayPeople(res)});

//////// ORGANIZATIONS
      $.post(
      'https://apiv2.indico.io/organizations',
        JSON.stringify({
          'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
          'data': tweets,
          'threshold': 0.5
      })
    ).then(function(res) { console.log("ORGANIZATIONS" + res); displayOrg(res)});

///////// AUDIENCE ENGAGEMENT
      $.post(
        'https://apiv2.indico.io/twitterengagement',
        JSON.stringify({
          'api_key': "784d8c79caa677d842bc1d3c4b8ddf9d",
          'data': tweets
        })
      ).then(function(res) { console.log("ENGAGEMENT" + res); displayEng(res)});


// var w = window.innerWidth;
// if (w < 800){
//   Chart.defaults.global.legend.display = false;
// }



///////////////////////////////////////////////
////////////////  DISPLAY DATA  ///////////////
///////////////////////////////////////////////
function displayPersona(res){
  var results = res;
  let resultsObj = JSON.parse(results);
  var persona = Object.keys(resultsObj.results);
  var about;

  if (persona == "architect") {
    about = "Imaginative and strategic thinkers, with a plan for everything.";
  } else if (persona == "logician") {
    about = "Innovative inventors with an unquenchable thirst for knowledge.";
  } else if (persona == "commander") {
    about = "Bold, imaginative and strong-willed leaders, always finding a way – or making one.";
  } else if (persona == "debater") {
    about = "Smart and curious thinkers who cannot resist an intellectual challenge.";
  } else if (persona == "advocate") {
    about = "Quiet and mystical, yet very inspiring and tireless idealists.";
  } else if (persona == "mediator") {
    about = "Poetic, kind and altruistic people, always eager to help a good cause.";
  } else if (persona == "protagonist") {
    about = "Charismatic and inspiring leaders, able to mesmerize their listeners.";
  } else if (persona == "campaigner") {
    about = "Enthusiastic, creative and sociable free spirits, who can always find a reason to smile.";
  } else if (persona == "logistician") {
    about = "Practical and fact-minded individuals, whose reliability cannot be doubted.";
  } else if (persona == "defender") {
    about = "Very dedicated and warm protectors, always ready to defend their loved ones.";
  } else if (persona == "executive") {
    about = "Excellent administrators, unsurpassed at managing things – or people.";
  } else if (persona == "consul") {
    about = "Extraordinarily caring, social and popular people, always eager to help.";
  } else if (persona == "virtuoso") {
    about = "Bold and practical experimenters, masters of all kinds of tools.";
  } else if (persona == "adventurer") {
    about = "Flexible and charming artists, always ready to explore and experience something new.";
  } else if (persona == "entrepreneur") {
    about = "Smart, energetic and very perceptive people, who truly enjoy living on the edge.";
  } else if (persona == "entertainer") {
    about = "Spontaneous, energetic and enthusiastic people – life is never boring around them.";
  }


  document.getElementById("persona").innerHTML += persona;
  document.getElementById("pBody").innerHTML += about;

};



function displayPersonality(res){
  var results = res;
  let resultsObj = JSON.parse(results);
  var keys = Object.keys(resultsObj.results);
  var values= Object.values(resultsObj.results);
  console.log(values)

  var ctx = document.getElementById('personality').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: keys,
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#FFC155",
          "#9b59b6",
        ],
        data: values
      }]
    }
  });
};

function displayEmotion(res){
  var results = res;
  let resultsObj = JSON.parse(results);
  var keys = Object.keys(resultsObj.results);
  var values= Object.values(resultsObj.results);
  console.log(values)

  var ctx = document.getElementById('emotion').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: keys,
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#ED4D4D",
          "#9b59b6",
          "#FFC155",
        ],
        data: values
      }]
    },
    size: {
      height: 50
    },
      options: {

           legend: {
              display: false
           },
          scales: {
      xAxes: [{
                  gridLines: {
                      color: "rgba(0, 0, 0, 0)",
                  }
              }],
      yAxes: [{
                  gridLines: {
                      color: "rgba(0, 0, 0, 0)",
                  },
          display: false,

              }]
      }
      }
  });
};

function displaySentiment(res){
  var results = res;
  let resultsObj = JSON.parse(results);
  value = Object.values(resultsObj);
  value = value*100;

  var chart = c3.generate({
      bindto: '#sentiment',
      data: {
          columns: [
              ['Sentiment', value]
          ],
          type: 'gauge',
          onclick: function (d, i) { console.log("onclick", d, i); },
          onmouseover: function (d, i) { console.log("onmouseover", d, i); },
          onmouseout: function (d, i) { console.log("onmouseout", d, i); }
      },
      gauge: {
      },
      color: {
          pattern: ['#2ecc71'] // the three color levels for the percentage values.
      },
      size: {
          height: 180
      }
  });
};

function displayTopics(res){
  var results = res;
  let resultsObj = JSON.parse(results);
  var keys = Object.keys(resultsObj.results);
  var keywords = keys;

  var theName = keys.value;
  keys.push(theName);
  document.getElementById("topics").innerHTML = "";
  for (var I = 0; I < keys.length-1; I++)
  {
       nameList = "<h5>" + keys[I] + "</h5>";
       document.getElementById("topics").innerHTML += nameList;
  }
};

function displayPolitical(res){
  var results = res;
  let resultsObj = JSON.parse(results);
  var keys = Object.keys(resultsObj.results);
  var values= Object.values(resultsObj.results);
  console.log(values)

  var ctx = document.getElementById('politics').getContext('2d');
  var myChart2 = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: keys,
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#FFC155",
          "#9b59b6",
        ],
        data: values
      }]
    },
    size: {
      height:300
    }
  });
  jQuery(window).trigger('resize');
};

function displayKeywords(res){
  var results = res;
  let resultsObj = JSON.parse(results);
  var keys = Object.keys(resultsObj.results);
  var keywords = keys;

  var theName = keys.value;
  keys.push(theName);
  document.getElementById("keywords").innerHTML = "";
  for (var I = 0; I < keys.length-1; I++)
  {
       nameList = "<h5>" + keys[I] + "</h5>";
       document.getElementById("keywords").innerHTML += nameList;
  }
};

function displayPeople(res){

};

function displayOrg(res){

};


function displayEng(res){
  var results = res;
  let resultsObj = JSON.parse(results);
  var engValue = Object.values(resultsObj);
  engValue = engValue*100;

  var chart = c3.generate({
      bindto: '#engagement',
      data: {
          columns: [
              ['Twitter Engagement', engValue]
          ],
          type: 'gauge',
          onclick: function (d, i) { console.log("onclick", d, i); },
          onmouseover: function (d, i) { console.log("onmouseover", d, i); },
          onmouseout: function (d, i) { console.log("onmouseout", d, i); }
      },
      gauge: {
      },
      color: {
          pattern: ['#3498db'] // the three color levels for the percentage values.
      },
      size: {
          height: 180
      }
  });
};

///////////// MISC /////////////





jQuery(window).trigger('resize');
</script>
