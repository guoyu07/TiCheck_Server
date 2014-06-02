<?php

namespace Contact\controllers;
class DefaultController extends \User\controllers\DefaultController
{
	protected $contacts;
	public function actionIndex()
	{
		$this->render('index');
	}

	public function prepareContacts()
	{
		if (!isset($_POST['Contacts']))
		{
			new \Error(4, "Contacts");
		}
		$Contacts = json_decode($_POST['Contacts'], true);
		//echo var_dump($Contacts);
		if ($Contacts)
		{
			$this->prepareUser();
			$this->contacts = $Contacts;
			$this->contacts['ID_user'] = $this->tiUser->ID;
		}
		else
			new \Error(4, "Contacts");
	}
}
