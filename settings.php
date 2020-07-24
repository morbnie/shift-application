<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:../index.php");
}else{
?>


<?
include 'top.php';
?>
<?
if($_GET[action] == "change_settings") {
if($_GET[post] == "true") {
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$email = $_POST[mail];
$phone = $_POST[phone];

mysql_query("UPDATE users SET email = '$email', phone = '$phone' WHERE id = '$show_tender[id]'");

}
}



if($_GET[action] == "change_psw") {
if($_GET[post] == "true") {



$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

if($_POST[password] == "") {
$message = "Password can't be blank";
}else{


$check_psw = md5($_POST[old_psw]);

if($show_tender[password] == $check_psw) {
if($_POST[password] == $_POST[new_psw2]) {


$psw = $_POST[password];

$insert_pwd = md5($psw);

mysql_query("UPDATE users SET password = '$insert_pwd' WHERE id = '$show_tender[id]'");

$message = "Password updated!";


}else{
$message = "The new password did not match";
}



}else{

$message = "Old password is wrong.";

}
}




}
}
?>
	<style type="text/css">

/* password strength */
.password_empty  {background-color: #CCCCCC; width:100%;}
.password_weak   {background-color: red; width:25%;}
.password_fair   {background-color: yellow; width:50%}
.password_good   {background-color: #6699CC; width:75%;}
.password_strong {background-color: green; width:100%;}
		</style>
	<script type="text/javascript">
	function updatePasswordStrength()
	{
          var password = document.change_psw.password.value;
	  var strength = 0;

          // easy_guesses: strings that should not be used in password
	  var easy_guesses = new Array();
          easy_guesses.push('kodeord'); // does this need to be localized?
          easy_guesses.push('zerich');
//          var email_words = document.change_psw.email.value.match(/\w+/g); // contiguous words contained in email
//	  if (email_words)
//             easy_guesses = easy_guesses.concat(email_words);
//          if (document.change_psw.username.value)
//   	     easy_guesses.push(document.change_psw.username.value);

	  locase_matches = password.match(/[a-z_]/g); // lowercase and '_' matches
	  digit_matches = password.match(/[0-9]/g);   // numeric matches
	  upcase_matches = password.match(/[A-Z]/g);  // uppercase matches
	  special_matches = password.match(/\W/g);    // special matches (not in a-z, A-Z, 0-9, _)

	  if (password.length>5)
	  { // for less than 5, leave strength at 0 since password too short

            // 1 point for each character more than 5
            strength += password.length - 5;

 	    // 1 point for each upcase character mixed with lowercase
	    if (locase_matches && upcase_matches)
	      strength += upcase_matches.length;

            // 1 point for each numeric character mixed with lowercase
	    if (locase_matches && digit_matches)
	      strength += digit_matches.length;

 	    // 1 point for each special characters
            if (special_matches)
	      strength += special_matches.length;

	   // 2 bonus points if mix of letters, numbers and special
           if ((locase_matches || upcase_matches) && special_matches && digit_matches)
             strength += 2;
          }

          // Reset strength to 0 if any easy guess in password (easy guess should be more than 3 chars)
          for (var i=0; i < easy_guesses.length; ++i)
	  {
           if (easy_guesses[i].length>3 && (password.indexOf(easy_guesses[i])!=-1))
           { 
             strength=0;
             break;
           }
          }

          var pstrength_elem = document.getElementById('password_strength');
          var pstrength_text = document.getElementById('password_strength_text');
          if (password.length==0)
          {
            pstrength_elem.className = 'password_empty';             
            pstrength_text.innerHTML = 'Empty';
          }
	  else if (strength<3)
          {
            pstrength_elem.className = 'password_weak';
            pstrength_text.innerHTML = 'Weak';
          }
          else if (strength<7)
          {
            pstrength_elem.className = 'password_fair';
            pstrength_text.innerHTML = 'Fair';
          }
          else if (strength<10)
          {
            pstrength_elem.className = 'password_good';
            pstrength_text.innerHTML = 'Good';
          }
          else
          {
            pstrength_elem.className = 'password_strong';
            pstrength_text.innerHTML = 'Strong';
          }
	}
	</script>

<?
$validUser = $_SESSION[myusername];
$query_id1 = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);
?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Settings</div>
							<div id="hovedtekst" class="hovedtekst">
							
							
							
					<?
if($message != "") {
echo $message;
}
?>					

                            
						
                        <form name="change_psw" id="change_psw" action="?action=change_psw&post=true" method="post">
<h3>Change Password:</h3>

<p><label for="email">Old password:</label> <input type="password" name="old_psw"><br>
<label for="email">New password:</label> <input type="password" class="input" id="password" name="password" size="20" onKeyUp="updatePasswordStrength()"><br>
<label for="email">New Password again:</label> <input type="password" name="new_psw2"></p>

<label for="email">&nbsp;</label>Password Strength: <span id="password_strength_text">Empty</span><table id="password_strength" class="password_empty" border="0" style="height:0.1em;"><tr><td></td></tr></table>

<label for="email">&nbsp;</label><input type="submit" value="Submit">
</form>



<form name="change_settings" id="change_sessings" action="?action=change_settings&post=true" method="post">
<h3>Change settings:</h3>
<p>
<label for="email">E-mail:</label> <input type="text" name="mail" value="<? echo $show_tender1[email]; ?>"><br>
<label for="email">Phone:</label> <input type="text" name="phone" value="<? echo $show_tender1[phone]; ?>"></p>
<label for="email">&nbsp;</label><input type="submit" value="Submit">
</form>
                  
						
						
						
						
						
						
						
						
						
						
						
						
						
</div>
			</div><!-- end slider -->
            
            <?
			include 'bottom.php';
			?>
			
			
<?
}
?>