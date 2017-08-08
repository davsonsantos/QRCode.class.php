<?php



class QRCodePHP{


	private static $BaseDir;//onde as imagem do QRCode serão armazenasda

	//inclui a biblioteca 
	function __construct($BaseDir = null){
		//Incliu a biblioteca
		include 'phpqrcode/qrlib.php'; 
		//varifica se a pasta uploads existe se mão cria
		self::$BaseDir = ( (string) $BaseDir ? $BaseDir : '../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
        //verifica se existe uma pasta chamada qrcode dentro da pasta uploads
        $this->CreateFolder("qrcode");
		
	}

	/*
	* <b>QRCodeSimple</b> - Retorna um texto na leitura do QRCode
	* @Data = recebe uma string
	*/
	function QRCodeSimple(array $Data){
		$Data['qrcode_name'] = (!empty($Data['qrcode_name']) ? $Data['qrcode_name'] : 'name_qrcode');
	    $Data['qrcode_size'] = (!empty($Data['qrcode_size']) ? $Data['qrcode_size'] : 3);
		QRcode::png($Data['Dados'], self::$BaseDir.'/'.'qrcode'.'/'.$Data['qrcode_name'].'.png', QR_ECLEVEL_L, $Data['qrcode_size']);
	}

	/*
	*<b>QRCodeEmail</b>
	* @Maito String: email da leitura
	* @Subject String: Assunto do Email
	* @Body String: Corpo do Email
	*/
	function QRCodeEmail(array $Data){
		$Data['qrcode_name'] = (!empty($Data['qrcode_name']) ? $Data['qrcode_name'] : 'name_qrcode');
	    $Data['qrcode_size'] = (!empty($Data['qrcode_size']) ? $Data['qrcode_size'] : 3);
		QRcode::png("mailto:" .$Data['Maito']."?subject=".$Data['Subject']."&body=".$Data['Body'] , self::$BaseDir.'/'.'qrcode'.'/'.$Data['qrcode_name'].'.png', QR_ECLEVEL_L, $Data['qrcode_size']);
	}

	/*<b>QRCodeCard</b> Cartão de Visita
	*
	*/
	function QRCodeCard(array $Data){

		// Dados Pessoais
	    $name         	=  (!empty($Data['name']) ? $Data['name'] : NULL); 
	    $PhoneJob       =  (!empty($Data['phoneHome']) ? $Data['phoneHome'] : NULL);
	    $PhoneHouse		=  (!empty($Data['phoneHome']) ? $Data['phoneHome'] : NULL);
	    $PhoneCell    	=  (!empty($Data['phoneCell']) ? $Data['phoneCell'] : NULL);
	    $orgName      	=  (!empty($Data['company']) ? $Data['company'] : NULL);
 
	    $email        	=  (!empty($Data['email']) ? $Data['email'] : NULL);

	    // Dados de Enredeço
	    $addressLabel     = (!empty($Data['addrLabel']) ? $Data['addrLabel'] : NULL);
	    $addressExt       = (!empty($Data['addrExtra']) ? $Data['addrExtra'] : NULL);
	    $addressStreet    = (!empty($Data['addrStreet']) ? $Data['addrStreet'] : NULL);
	    $addressCity      = (!empty($Data['addrCity']) ? $Data['addrCity'] : NULL);
	    $addressUF	      = (!empty($Data['addrUF']) ? $Data['addrUF'] : NULL);
	    $addressCep 	  = (!empty($Data['addrCep']) ? $Data['addrCep'] : NULL);
	    $addressCountry   = (!empty($Data['addrCountry']) ? $Data['addrCountry'] : NULL);

	    //Array com os dados informados
	    $codeContents  = 'BEGIN:VCARD'."\n"; 
	    $codeContents .= 'VERSION:2.1'."\n"; 
	    $codeContents .= 'FN:'.$name."\n"; 
	    $codeContents .= 'ORG:'.$orgName."\n"; 

	    //if($phone != null):
	    	$codeContents .= 'TEL;WORK;VOICE:'.$PhoneJob."\n"; 
		//endif;
	    $codeContents .= 'TEL;HOME;VOICE:'.$PhoneHouse."\n"; 
	    $codeContents .= 'TEL;TYPE=cell:'.$PhoneCell."\n"; 

	    $codeContents .= 'ADR;TYPE=work;'. 
        'LABEL="'.$addressLabel.'":' 
        .$addressExt.';' 
        .$addressStreet.';' 
        .$addressCity.';' 
        .$addressUF.';'
        .$addressCep.';' 
        .$addressCountry 
    	."\n"; 

	    $codeContents .= 'EMAIL:'.$email."\n"; 

	    $codeContents .= 'END:VCARD'; 

	    $Data['qrcode_name'] = (!empty($Data['qrcode_name']) ? $Data['qrcode_name'] : 'name_qrcode');
	    $Data['qrcode_size'] = (!empty($Data['qrcode_size']) ? $Data['qrcode_size'] : 3);
		QRcode::png( $codeContents,  self::$BaseDir.'/'.'qrcode'.'/'.$Data['qrcode_name'].'.png', QR_ECLEVEL_L, $Data['qrcode_size']);
	}

	function QRCodeSkype(array $Data){
		$skypeUserName = $Data['nickname'];
		$content = 'skype:'.urlencode($skypeUserName).'?call'; 
		$Data['qrcode_name'] = (!empty($Data['qrcode_name']) ? $Data['qrcode_name'] : 'name_qrcode');
		$Data['qrcode_size'] = (!empty($Data['qrcode_size']) ? $Data['qrcode_size'] : 1);
		QRcode::png( $content,  self::$BaseDir.'/'.'qrcode'.'/'.$Data['qrcode_name'].'.png', QR_ECLEVEL_L , $Data['qrcode_size']);
	}


	//Verifica e cria o diretório base!
    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

}
