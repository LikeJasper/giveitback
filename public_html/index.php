<?php

// $db = new mysqli(DETAILS);

if($db->connect_errno > 0){
    die('Unable to connect to database');
}

$sql = <<<SQL
    SELECT SUM(`pledge_amount`)
    AS `pledge_total`
    FROM `pledge`
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query');
}

$total = 0;

while($row = $result->fetch_assoc()){
    $total = $row['pledge_total'];
}

$result->free();
$db->close();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="See how much your tax break is this year. Why not donate it to help those who have been hardest hit by spending cuts?">

    <meta property="og:title" content="Give It Back">
    <meta property="og:type" content="article">
    <meta property="og:image" content="http://www.giveitback.uk/static/images/logo-giveitback.png">
    <meta property="og:url" content="http://www.giveitback.uk">
    <meta property="og:description" content="See how much your tax break is this year. Why not give it back to those who have been hardest hit by spending cuts?">
    <meta property="fb:admins" content="614414000">
    <meta property="fb:admins" content="562225363">
    <meta property="fb:app_id" content="1441980756125587">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="http://www.giveitback.uk">
    <meta name="twitter:title" content="Give It Back">
    <meta name="twitter:description" content="See how much your tax break is this year. Why not give it back to those who have been hardest hit by spending cuts?">
    <meta name="twitter:image" content="http://www.giveitback.uk/static/images/logo-giveitback.png">

    <title>Give It Back</title>
    <link rel="author" href="https://plus.google.com/111511979202703026877">

    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css" media="screen,projection">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Muli:400,400italic" rel="stylesheet" type="text/css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="static/css/giveitback.css">
    <link rel="shortcut icon" href="static/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="static/images/favicon.ico" type="image/x-icon">
    <link rel="image_src" href="static/images/logo-giveitback.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body class="grey darken-3 white-text">
<main>
    <div id="content-wrapper">
        <div class="taxes-img-bg valign-wrapper">
            <div class="container center dark-container">
                <div id="leader" class="row section">
                    <div class="col s12 m4">
                        <div class="row">
                            <h1 id="leader-heading" class="col s12 red darken-4 s-bottomless">Give It Back</h1>
                        </div>
                    </div>
                    <div class="col s12 m8 flow-text justify">
                        <p class="s-bottomless">If you earn under &pound;120,924 you'll be up to &pound;184 better off this year thanks to the income tax and NI breaks brought in by George Osborne.<br>Meanwhile crucial safety nets for the most vulnerable members of society are suffering deep funding cuts.</p>
                    </div>
                <div id="calculator-input" class="row section">
                    <div class="col s12 s-bottomless">
                        <div class="row">
                            <h3 id="id_cta_extra" class="col s12 s-bottomless">See how much extra you're getting:</h3>
                        </div>
                    </div>
                    <form id="calculator-form" class="col s12">
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m1">
                                <i class="prefix">&pound;</i>
                                <input id="salary" class="validate" type="number" min="0.01" step="0.01">
                                <label for="salary" class="white-text">Your salary</label>
                            </div>
                            <div class="input-field col s9 m3 l2 offset-s1">
                                <select id="period" class="browser-default black-text">
                                  <option value="yearly" selected>per year</option>
                                  <option value="monthly">per month</option>
                                </select>
                            </div>
                            <div class="input-field col s2 m1">
                                <button class="btn-floating red darken-4 waves-effect waves-light" type="submit"><i class="mdi-content-forward"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <div id="dark-section">
            <div id="hidden-stuff" class="black-text">
                <div class="container center">
                    <div id="results" class="section card">
                        <div class="row no-margin-bottom">
                            <div class="col s12 m5 l4">
                                <div class="heading-spacer"></div>
                                <h2 class="container green-text text-darken-2">Results</h2>
                            </div>
                            <div class="col s12 m7 l8">
                                <p class="flow-text">You're getting an extra <span class="strong green-text text-darken-2">&pound;<span id="bonus_value">XXX</span></span> this year because of additional tax breaks.</p>
                            </div>
                        </div>
                        <div class="container">
                            <p id="id_disclaimer" class="left-align"><span class="strong">IMPORTANT!</span> This tool makes a quick calculation based on standard assumptions to estimate your tax break. There are many other variables which may need to be considered for a definitive value. Check your tax code and speak to HMRC.</p>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div id="donate" class="section grey lighten-3">
                        <div class="row">
                            <div class="col s12">
                                <h4 id="id_suggestion" class="">Why not give that money back to those who are losing out? It's &pound;XX.XX per month.</h4>
                            </div>
                            <div class="row">
                                <div class="col s12 m4">
                                    <a href="https://www.emmaus.org.uk/donate?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank" class="donate-link">
                                        <div class="card">
                                            <div class="card-image">
                                                <img src="static/images/logo-emmaus.jpg">
                                            </div>
                                            <div class="card-content black-text">
                                                <p>"Emmaus (pronounced em-MAY-us) is a homelessness charity with a difference. We don’t just give people a bed for the night; we offer a home, meaningful work and a sense of belonging."</p>
                                            </div>
                                            <div class="card-action">
                                                <a href="https://www.emmaus.org.uk/donate?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank" class="donate-link">Donate now</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col s12 m4">
                                    <a href="https://www.refuge.org.uk/single-online-donation/?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank" class="donate-link">
                                        <div class="card">
                                            <div class="card-image">
                                                <img src="static/images/logo-refuge.png">
                                            </div>
                                            <div class="card-content black-text">
                                                <br>
                                                <p>"On any given day Refuge supports over 3,300 women and children experiencing domestic violence, sexual violence, female genital mutilation (FGM), forced marriage, stalking, trafficking, prostitution and so-called ‘honour’ based violence."</p>
                                            </div>
                                            <div class="card-action">
                                                <a href="https://www.refuge.org.uk/single-online-donation/?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank" class="donate-link">Donate now</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col s12 m4">
                                    <a href="http://donate.foodcycle.org.uk/portal/public/donate/donate.aspx?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank" class="donate-link">
                                        <div class="card">
                                            <div class="card-image">
                                                <img src="static/images/logo-foodcycle.jpg">
                                            </div>
                                            <div class="card-content black-text">
                                                <br>
                                                <p>"FoodCycle runs volunteer-powered community projects across the UK – all working to reduce food poverty and social isolation by serving tasty, nutritious meals to vulnerable people."</p>
                                            </div>
                                            <div class="card-action">
                                                <a href="http://donate.foodcycle.org.uk/portal/public/donate/donate.aspx?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank" class="donate-link">Donate now</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div id="id_social_buttons" class="container">
                                <div class="row center">
                                    <p class="no-margin-bottom flow-text">Please share this site so others can join in.</p>
                                </div>
                                <div class="row center">
                                    <a class="col s12 m4 btn light-blue darken-4 white-text" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.giveitback.uk" target="_blank" title="Share on Facebook"><i class="fa fa-facebook-square fa-2x"></i>&nbsp;&nbsp;Share</a>
                                    <a class="col s12 m4 btn light-blue" href="https://twitter.com/intent/tweet?url=giveitback.uk&hashtags=GiveItBack&text=I%27m%20donating%20my%20tax%20break%20this%20year.%20Why%20don%27t%20you%3F%20http%3A%2F%2Fwww.giveitback.uk" target="_blank" title="Share on Twitter"><i class="fa fa-twitter-square"></i>&nbsp;&nbsp;Share</a>
                                    <a class="col s12 m4 btn blue darken-2" href="https://www.linkedin.com/shareArticle?mini=true&url=http://www.giveitback.uk&title=Give%20It%20Back&summary=I%27m%20donating%20my%20tax%20break%20this%20year.%20Why%20don%27t%20you%3F" target="_blank" title="Share on LinkedIn"><i class="fa fa-linkedin-square"></i>&nbsp;&nbsp;Share</a>
                                </div>
                            </div>
                            <div id="id_pledge" class="row card">
                                <div class="container">
                                    <h4 class="row header">Help us keep track:<br>how much will you donate?</h4>
                                    <form id="id_pledge_form" class="row" action="pledge.php" method="post" target="_blank">
                                        <div class="col s7 m4 offset-s2 offset-m2 input-field">
                                            <i class="prefix">&pound;</i>
                                            <input id="id_amount" class="validate right-align" name="pledge_amount" type="number" min="0.01" step="0.01">
                                            <label for="id_amount" id="id_pledge_amount_label" class="grey-text">Amount</label>
                                        </div>
                                        <div class="col s12 m4 input-field">
                                            <input id="id_pledge_submit" class="btn-large green darken-2" type="submit" value="Pledge">
                                        </div>
                                    </form>
                                    <div class="row">
                                        <p>&pound;<span id="id_pledge_total"><?php echo $total; ?></span> pledged so far in response to these tax breaks.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="about" class="white black-text">
            <div class="container center">
                <div id="about" class="section">
                    <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <h2 class="header center">About this tool</h2>
                            </div>
                            <div id="about_text" class="row justify">
                                <p>Since May 2010, income tax breaks have handed hundreds of pounds to middle- and high-income households. These have been paid for by massive cuts to public services and the welfare system which have disproportionately affected the poorest and most vulnerable members of society.</p>
                                <p>As a result, hundreds of thousands of people have been driven to food banks to feed themselves and hundreds more people are sleeping on the streets. More than one in six women’s refuges have shut, leaving many women fleeing domestic violence with nowhere to go.</p>
                                <p>If you believe that everyone should have enough to eat, a roof over their head, and confidence in their personal safety, please consider donating your most recent tax break to help those who are paying for it – the hungry, the homeless, and the desperate.</p>
                                <p class="strong">Give It Back.</p>
                                <div class="container">
                                    <img src="static/images/chart-ifs.png" alt="IFS Chart" class="responsive-img materialboxed">
                                    <p class="small-text">The 2015 July budget continues to take disproportionately from the poorest households, as shown by this IFS analysis. Source: <a href="http://www.ifs.org.uk/publications/7855" target="_blank">Hood, A. (2015) Benefit changes and distributional analysis. &copy;Institute for Fiscal Studies</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="faq">
            <div class="container center">
                <div id="about" class="section">
                    <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <h2 class="header center">FAQ</h2>
                            </div>
                            <div class="row">
                                <ul class="collapsible justify grey lighten-4 black-text" data-collapsible="accordion">
                                    <li>
                                        <div class="collapsible-header black-text"><i class="material-icons">info_outline</i>Calculation</div>
                                        <div class="collapsible-body">
                                            <p><span class="faq-question">What sort of taxes are you considering here?</span><br><br>
                                            We use changes in income tax and national insurance between 2014-2015 and 2015-2016 to calculate your tax break. You may personally be affected by tax increases/decreases in many other areas.<br><br>
                                            If your salary has changed between last year and this year we calculate the difference between how much you will pay this year and how much you would have paid on this year's salary if no changes to income tax or national insurance had been made since last year.</p>
                                            <p><span class="faq-question">What assumptions have you used to work out my tax saving?</span><br><br>
                                            Some standard assumptions we have made are as follows, although this is not an exhaustive list:</p>
                                            <ul class="container">
                                                <li>- All of your income is earned employment income</li>
                                                <li>- You pay national insurance</li>
                                                <li>- You were born after 6 April 1938</li>
                                                <li>- You are not blind</li>
                                                <li>- You do not benefit from the Marriage Allowance</li>
                                            </ul>
                                            <br>
                                            <p><span class="faq-question"><a href="http://www.bbc.com/news/business-17442946" target="_blank">This BBC calculator</a> gives different results. Are you sure your calculations are right?</span><br><br>
                                            That BBC calculator tells you how you'll be affected next year (2016–17) compared to this year (2015–16). Our tool tells you how you're doing this year compared to last year (2014–15).</p>
                                            <br>
                                            <p><span class="faq-question">Doesn't the same argument apply to tax breaks introduced last year?</span><br><br>
                                            Feel free to pledge/donate more!</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header black-text"><i class="material-icons">info</i>Income brackets</div>
                                        <div class="collapsible-body">
                                            <p><span class="faq-question">How are you defining low-, middle-, and high-income earners?</span><br><br>
                                            Our claim is based on research undertaken by the <a href="http://www.ifs.org.uk/uploads/publications/bns/BN159.pdf">Institute for Fiscal Studies</a> which divides different types of households into deciles.  Their research shows that the poorest 50% of households have suffered most from cuts to social security, while those in the top half but not the top 10% have, on average, fared best. In monetary terms, this equates to a single person earning more than &pound;15,888 after tax and benefits in 2013, a couple without children earning over &pound;26,047, or a couple with two children earning &pound;38,028.</p>
                                            <p><span class="faq-question">I’m a middle- or high-income earner but I don’t feel better off in the last five years.</span><br><br>
                                            It is of course difficult to talk about income brackets when households vary significantly. According to the <a href="http://www.ifs.org.uk/uploads/publications/bns/BN159.pdf">Institute for Fiscal Studies</a>, some types of household suffered worse than others. Significantly, the fourth to ninth deciles of households without children have actually seen gains in net income since 2010, while even the highest income groups with children have seen net losses since 2010 because of changes to child benefit. However, overall, the lowest deciles have suffered much more, losing a much larger percentage of their net income than those richer households that have lost out slightly.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header black-text"><i class="material-icons">info_outline</i>Charities</div>
                                        <div class="collapsible-body">
                                            <p><span class="faq-question">Why have you chosen to suggest these charities specifically?</span><br><br>
                                            The cuts to social security and public services have been wide-ranging, and it would not be possible to give a prominent position to every charity or campaign group seeking to address their effects. We have chosen to focus on homelessness, hunger and domestic violence as these strike us as some of the worst effects of the cuts made since 2010, requiring support most urgently.<br><br>
                                            There are of course many other UK charities doing great work in these and other affected fields.<br><br>
                                            We are not affiliated with Emmaus, Refuge, FoodCycle or any other charity and do not receive commission from anyone.</p>
                                            <p><span class="faq-question">Can I pledge my donation to a different charity?</span><br><br>
                                            You can of course pledge to donate to other relevant charities or campaign groups. Besides <a href="https://www.emmaus.org.uk/donate?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank">Emmaus</a>, <a href="https://www.refuge.org.uk/single-online-donation/?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank">Refuge</a> and <a href="http://donate.foodcycle.org.uk/portal/public/donate/donate.aspx?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank">FoodCycle</a>, these charities also deal with affected areas:</p>
                                            <ul class="container">
                                                <li><br><a href="http://www.centrepoint.org.uk/donate?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank"><img src="static/images/logo-centrepoint.jpg" alt="Centrepoint">
                                                </a><br>"Centrepoint is the UK’s leading charity for homeless young people. It supports over 8,400 16-25 year olds into housing and employment every year. Working directly in London and the north of England, Centrepoint's work covers all of the UK through a network of 40 partner organisations. It also gives homeless young people a voice through the Centrepoint Parliament, an elected body of young people representing and working on behalf of young people. Centrepoint conducts research and influences government policy with the overall aim of ending youth homelessness."<br><a href="http://www.centrepoint.org.uk/donate?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank">DONATE NOW
                                                </a></li>
                                                <li><br><a href="http://passage.org.uk/how-you-can-help/make-a-donation/?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank"><img src="static/images/logo-thepassage.jpg" alt="The Passage"></a><br>"Our aim is to provide homeless people with support to transform their own lives. The Passage runs London’s largest voluntary sector resource centre for homeless and vulnerable people: each day we help up to 200 men and women. We welcome and treat clients with respect and dignity, and find out what they need and want. We offer professional and appropriate advice and help according to the client’s needs and aspirations. We agree an action plan with clients which is time limited with the aim of supporting clients out of homelessness."<br><a href="http://passage.org.uk/how-you-can-help/make-a-donation/?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank">DONATE NOW
                                                </a></li>
                                                <li><br><a href="http://www.mungosbroadway.org.uk/how_you_can_help/make_a_donation?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank">St Mungo's Broadway</a><br>"St Mungo's Broadway helps people recover from the issues that create homelessness and to rebuild their lives. We provide a bed and support to more than 2,500 people a night who are either homeless or at risk, and work to prevent homelessness, helping about 25,000 people a year. We support men and women through more than 250 projects including emergency, hostel and supportive housing projects; advice services; specialist physical and mental health services; skills and work services. We currently work across London and the south of England including in Bristol, Reading, Milton Keynes, Oxfordshire and Sussex."<br><a href="http://www.mungosbroadway.org.uk/how_you_can_help/make_a_donation?referrer=http%3A%2F%2Fwww.giveitback.uk" target="_blank">DONATE NOW
                                                </a></li>
                                            </ul>
                                            <br><br>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header black-text"><i class="material-icons">info</i>Sources</div>
                                        <div class="collapsible-body">
                                            <p><span class="faq-question">Do you have a source for your claim that the cuts have disproportionately affected the poorest and most vulnerable?</span><br><br>
                                            Yes: <a href="http://www.ifs.org.uk/uploads/publications/bns/BN159.pdf" target="_blank">Institute for Fiscal Studies</a></p>
                                            <p><span class="faq-question">Do you have a source for your claim about increased food bank use?</span><br><br>
                                            Yes: <a href="http://www.bbc.co.uk/news/uk-32406120" target="_blank">BBC</a></p>
                                            <p><span class="faq-question">Do you have a source for your claim about increased rough sleeping?</span><br><br>
                                            Yes: <a href="http://www.telegraph.co.uk/news/politics/11437220/Rough-sleeping-rises-55-per-cent-under-Coalition.html" target="_blank">The Telegraph</a></p>
                                            <p><span class="faq-question">Do you have a source for your claim about closures of women's refuges?</span><br><br>
                                            Yes: <a href="https://www.unison.org.uk/upload/sharepoint/On%20line%20Catalogue/23139.pdf" target="_blank">Unison</a></p>
                                            <p><span class="faq-question">I'd like some more context for that graph.</span><br><br>
                                            You can view the full PDF here: <a href="http://www.ifs.org.uk/uploads/publications/budgets/Budgets%202015/Summer/Hood_distributional_analysis.pdf" target="_blank">Hood, A. (2015) Benefit changes and distributional analysis. &copy;Institute for Fiscal Studies</a></p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header black-text"><i class="material-icons">info_outline</i>Data</div>
                                        <div class="collapsible-body">
                                            <p><span class="faq-question">Are you storing my data?</span><br><br>
                                            We don't store information about your salary: the calculation is carried out on your computer and we never have access to the figure.<br><br>
                                            If you use the pledge form to tell us how much you're donating, we store that amount pseudonymously so we can keep a running total. We have no way of tracing it back to you personally.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header black-text"><i class="material-icons">info</i>Creators</div>
                                        <div class="collapsible-body">
                                            <p><span class="faq-question">Who are you?</span><br><br>
                                            Will is a web developer who doesn't currently live in the UK but still cares about it.<br><br>
                                            Jay is an accountant who likes social justice as much as he likes numbers.<br><br>
                                            We are not affiliated with any of the charities listed on this site, and we do not receive commission from any of them. We fund this site ourselves.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header black-text"><i class="material-icons">info_outline</i>Enquiries</div>
                                        <div class="collapsible-body"><p>Email us here: enquiries [at] giveitback.uk</p></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="red darken-4 valign-wrapper">
    <div class="container center">
        <div class="row center hide-on-small-only">
            <div class="footer-spacer"></div>
            <a class="btn light-blue darken-4 white-text" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.giveitback.uk" target="_blank" title="Share on Facebook"><i class="fa fa-facebook-square fa-2x"></i>&nbsp;&nbsp;Share</a>
            <a class="btn light-blue" href="https://twitter.com/intent/tweet?url=giveitback.uk&hashtags=GiveItBack&text=I%27m%20donating%20my%20tax%20break%20this%20year.%20Why%20don%27t%20you%3F%20http%3A%2F%2Fwww.giveitback.uk" target="_blank" title="Share on Twitter"><i class="fa fa-twitter-square"></i>&nbsp;&nbsp;Share</a>
            <a class="btn blue darken-2" href="https://www.linkedin.com/shareArticle?mini=true&url=http://www.giveitback.uk&title=Give%20It%20Back&summary=I%27m%20donating%20my%20tax%20break%20this%20year.%20Why%20don%27t%20you%3F" target="_blank" title="Share on LinkedIn"><i class="fa fa-linkedin-square"></i>&nbsp;&nbsp;Share</a>
        </div>
        <div class="row center hide-on-med-and-up">
            <div class="footer-spacer"></div>
            <a class="col s12 btn light-blue darken-4 white-text" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.giveitback.uk&t=" target="_blank" title="Share on Facebook"><i class="fa fa-facebook-square fa-2x"></i>&nbsp;&nbsp;Share</a>
            <a class="col s12 btn light-blue" href="https://twitter.com/intent/tweet?url=giveitback.uk&hashtags=GiveItBack&text=I%27m%20donating%20my%20tax%20break%20this%20year.%20Why%20don%27t%20you%3F%20http%3A%2F%2Fwww.giveitback.uk" target="_blank" title="Share on Twitter"><i class="fa fa-twitter-square"></i>&nbsp;&nbsp;Share</a>
            <a class="col s12 btn blue darken-2" href="https://www.linkedin.com/shareArticle?mini=true&url=http://www.giveitback.uk&title=Give%20It%20Back&summary=I%27m%20donating%20my%20tax%20break%20this%20year.%20Why%20don%27t%20you%3F" target="_blank" title="Share on LinkedIn"><i class="fa fa-linkedin-square"></i>&nbsp;&nbsp;Share</a>            
        </div>
    </div>
</footer>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
<script>
$(document).ready(function() {
    $('select').material_select();
});
</script>
<script type="text/javascript" src="static/js/giveitback.js"></script>
</body>

</html>