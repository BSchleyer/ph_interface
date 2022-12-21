<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class MainConstants
{
	public static $ErrorNoConfig = "No Config File found";
	public static $ErrorNoDebugVariable = "No Debug Variable set in Config";

	const affiliate_maxlinks = 3;
	const affiliate_maxLimitReached = "Link Maximum erreicht";
	const affiliate_linkexists = "Link existiert bereits";
	const affiliate_blacklistword = "Link enthält ein Wort das nicht erlaubt ist";
	const affiliate_blacklistchar = "Link enthält ein Zeichen das nicht erlaubt ist";
	const affiliate_maxChars = 16;
	const affiliate_maxCharsMessage = "Der Link darf Maximal 16 Zeichen enthalten";
	const affiliate_minChars = 4;
	const affiliate_minCharsMessage = "Der Link muss Mindestens 4 Zeichen haben";
	const FailVariable = "Fehlende Variable ";
}