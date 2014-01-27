<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential config-file which also creates the $anax variable with its defaults.
include(__DIR__.'/config.php'); 
$anax['stylesheets'][] = 'css/form.css';
$anax['style'] =<<<EOD
.comments,
.comment-form {
  width: 700px;
  margin-bottom: 44px;
}
EOD;


// Prepare incoming
$content  = isset($_POST['content'])        ? $_POST['content']       : null;
$name     = isset($_POST['name'])           ? $_POST['name']          : null;
$web      = isset($_POST['web'])            ? $_POST['web']           : null;
$mail     = isset($_POST['mail'])           ? $_POST['mail']          : null;
$ip       = isset($_SERVER['REMOTE_ADDR'])  ? $_SERVER['REMOTE_ADDR'] : null;
$create   = isset($_POST['create'])         ? $_POST['create']        : null;
$delete   = isset($_POST['delete'])         ? $_POST['delete']        : null;
$output = null;



// Validate and constrain incoming



// Prepare and init the comments-class
$comments = new Mos\Comment\CCommentInSession (array(
  'key'  => 'page-with-comments',
));



// Is form submitted?
// Add new comment
if($create) {
  $res = $comments->save(array(
    'content' => $content,
    'name'    => $name,
    'web'     => $web,
    'mail'    => $mail,
    'ip'      => $ip,
  ));

  if(!$res) {
    $output = "Kunde inte spara kommentaren.";
  }
  else {
    header("Location: " . $_SERVER['PHP_SELF']);
  }
}

// remove all comments
else if($delete) {
  $res = $comments->deleteAll();
  if($res) {
    $output = "Alla kommentarer raderades.";
    header("Location: " . $_SERVER['PHP_SELF']);
  }
  else {
    $output = "Kommentarerna kunde inte raderas.";
  }
}


// Prepare page content with comment fields
$content  = htmlentities($content);
$name     = htmlentities($name);
$web      = htmlentities($web);
$mail     = htmlentities($mail);

$form = <<<EOD
<form method=post>
  <fieldset>
  <legend>Lämna en kommentar</legend>
  <p><label>Kommentar:<br/><textarea name='content'>$content</textarea></label></p>
  <p><label>Namn:<br/><input type='text' name='name' value='$name'/></label></p>
  <p><label>Hemsida:<br/><input type='text' name='web' value='$web'/></label></p>
  <p><label>Mail:<br/><input type='text' name='mail' value='$mail'/></label></p>
  <p class=buttons><input type='submit' name='create' value='Kommentera'/>
    <input type='reset' value='Återställ'/>
    <input type='submit' name='delete' value='Ta bort alla kommentarer'/>
  </p>
  <output>{$output}</output>
  </fieldset>
</form>
EOD;



// Read all comments related to this documet
$comments->findAllByKey();



// Do it and store it all in variables in the Anax container.
$anax['title'] = "Sida med kommentarer - pagecontroller";

$anax['main'] = <<<EOD
<h1>Sida med innehåll och kommentarer</h1>
<p>Detta är en exempelsida som visar hur en Anax sidkontroller kan fungera tillsammans med kommentarer.</p>
<p>Här kan jag skriva ett fint innehåll, eller hämta innehåll från databasen.</p>
<p>Kommentarerna kan kopplas till godtycklig sida, via en nyckel.</p>

<hr>

<h2>Kommentarer</h2>

<div class='comments'>
{$comments}
</div>

<div class='comment-form'>
{$form}
</div>
EOD;



// Finally, leave it all to the rendering phase of Anax.
include(ANAX_THEME_PATH);
