<?php


 /**
  * An array of neat captions
  * to choose from
  *
  * @var array
  */
$quote = array(
    "Alls I need is \n" . $dm->randomWord() . ", " . $dm->randomWord() . " & \n " . $dm->randomWord() . "\n and I'm just fine. \n - Eddie Vader ",
    "Grateful for every \n" . $dm->randomWord() . " that life gives me. \n Even the " . $dm->randomWord(). " ones \n #" . $dm->randomWord(). "\n - Hugo Bose",
    "Don't worry about  \n" . $dm->randomWord()  .", There's \na " . $dm->randomWord() . " waiting \n for you just \n around the corner.\n " . "#" . $dm->randomWord() . "\n - Mork Twain",
    "When life gives you \n" . $dm->randomWord() . "\n Make " . $dm->randomWord() . "ade. \n - James Joyce",
    "For every " . $dm->randomWord() . "\n There's an equal \n and opposite \n" . $dm->randomWord() . "\n - Albert Einstine",
    "If you can \n Dream a " . $dm->randomWord() . "\n Then you can BE a \n" . $dm->randomWord() . "\n - Mark E Smith",
    "When I was a boy \n I dreamed of \n" . $dm->randomWord() . "s. Now \n I own 50 " . $dm->randomWord() . "s\n - Stefe Jobs",
    "If I told you \n that I ate 25 \n" . $dm->randomWord() . "s a day, \n would you be suprised? \n - Stive Jobs",
    "I am as strong as 40 \n" . $dm->randomWord() . "s. And more muscular \n than all the ". $dm->randomWord() . "s.\n - Deerpark Chopra",
    "A wise man can become \n Wealthy with just \n ". $dm->randomWord() . "s, ". $dm->randomWord() . "s, \n and a " . $dm->randomWord() . "\n - Steve Jibs",
    "Nothing's going to change \n my love for " . $dm->randomWord() . "\n I want to tell the \n world how much I \n " . $dm->randomWord() . " you. \n - Glen Frey",
    "Wherever you go, \n whatever you do \n I will be right here \n waiting for " . $dm->randomWord() ."s\n - Karl Marx",
    "The less you open \nyour heart to ".$dm->randomWord()."s,\n the more your ".$dm->randomWord()." suffers. \n- Deepak Oprah",
    "The way you ".$dm->randomWord().", \nthe way you ".$dm->randomWord().", \nthe way you ".$dm->randomWord().", \ncan influence your life \n by 70 to 120 years. \n- Deepak Chopper"
);
shuffle($quote);
