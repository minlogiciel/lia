<?php
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# @title
#   Barcode
#
# @description
#   Barcode generation classes 
#
# @topics   contributions
#
# @created
#   2001/08/15
#
# @organisation
#   UNILASALLE
#
# @legal
#   UNILASALLE
#   CopyLeft (L) 2001-2002 UNILASALLE, Canoas/RS - Brasil
#   Licensed under GPL (see COPYING.TXT or FSF at www.fsf.org for
#   further details)
#
# @author
#   Rudinei Pereira Dias     [author] [rudinei@lasalle.tche.br]
# 
# @history
#   $Log: barcode.class,v 1.0
#			Modificado dia 28/04/2005 - Rafael Riedel
#			Implementado opção para gerar como imagem ao invés de HTML
#
# @id $Id: barcode.class,v 1.1 2002/10/03 19:14:05 vgartner Exp $
#---------------------------------------------------------------------

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
# Rotina para a geração de Código de Barra
# no padrão Interleved 2 of 5 (Intercalado 2 de 5)
# utilizado para os documentos bancários conforme
# padrão FEBRABAN.
#---------------------------------------------------------------------




class BarcodeI25
{    
    //Public properties
    var $codigo;       //SET: Code to transform in barcode 
    var $ebf;          //SET: Width of slim bar 
    var $ebg;          //SET: Width of fat bar 
    var $altb;         //SET: Barcode heigth 
    var $ipp;          //SET: Black point url reference
    var $ipb;          //SET: White point url reference 
    var $tamanhoTotal; //RETURN: Field to return HTML image barcode total size 
	var $ignoreTable;  //SET: if set to true, ignore table construction around barcode
	var $tipoRetorno;  //SET: if set to 0 (or ignored) this code will produce an HTML code, if set to 1, will return an PNG Image 
	
    //Private properties
    var $mixed_code;
    var $bc = array();
    var $bc_string;
	var $errors;
    
    function BarcodeI25($code='')
    {
        //Construtor da classe
		$this->ignoreTable = false;
		$this->errors       = 0;
        $this->ebf          = 1;
        $this->ebg          = 3;
        $this->altb         = 50;
        $this->ipp          = "ponto_preto.gif";
        $this->ipb          = "ponto_branco.gif";
        $this->mixed_code   = "";
        $this->bc_string    = "";
        $this->tamanhoTotal = 0;
		$this->tipoRetorno	= 0; 
        
        if ( $code !== '' )
        {
            $this->SetCode($code);
        }
    }
    
    function SetCode($code)
    {   global $MIOLO;
	
		$code = trim($code);
        
        if (strlen($code)==0) { 
			echo "Barcode Undefined";
			$this->errors = $this->errors + 1;
		}
        if ((strlen($code) % 2)!=0) { 
			echo "Invalid barcode lenght";
			$this->errors = $this->errors + 1;
		}

        if ($this->errors == 0) {
        	$this->codigo = $code;
        }
    }
    
    function GetCode()
    {
        return $this->codigo;
    }
    
    function Generate()
    {   
		if ($this->errors > 0) {
			echo "Can't create barcode.";
		}else{
			
			$this->codigo = trim($this->codigo);
	        
	        $th = "";
	        $new_string = "";
	        $lbc = 0; $xi = 0; $k = 0;
	        $this->bc_string = $this->codigo;
	        
	        //define barcode patterns
	        //0 - Estreita    1 - Larga
	        //Dim bc(60) As String   Obj.DrawWidth = 1
	        
	        $this->bc[0]  = "00110";         //0 digit
	        $this->bc[1]  = "10001";         //1 digit
	        $this->bc[2]  = "01001";         //2 digit
	        $this->bc[3]  = "11000";         //3 digit
	        $this->bc[4]  = "00101";         //4 digit
	        $this->bc[5]  = "10100";         //5 digit
	        $this->bc[6]  = "01100";         //6 digit
	        $this->bc[7]  = "00011";         //7 digit
	        $this->bc[8]  = "10010";         //8 digit
	        $this->bc[9]  = "01010";         //9 digit
	        $this->bc[10] = "0000";          //pre-amble
	        $this->bc[11] = "100";           //post-amble
	        
	        $this->bc_string = strtoupper($this->bc_string);
	        
	        $lbc = strlen($this->bc_string) - 1;
	        
	        for( $xi=0; $xi<= $lbc; $xi++ )
	        {
	            $k = (int) substr($this->bc_string,$xi,1);
	            $new_string = $new_string . $this->bc[$k];
	        }
	        
	        $this->bc_string = $new_string;
	        
	        $this->MixCode();
	        
	        $this->bc_string = $this->bc[10] . $this->bc_string .$this->bc[11];  //Adding Start and Stop Pattern
	        
	        $lbc = strlen($this->bc_string) - 1;
	        
	        $barra_html="";
	        
			// -> Verification
			if($this->tipoRetorno == 1) {
				for( $xi=0; $xi<= $lbc; $xi++ )  {
					$imgWid = ( $this->bc_string[$xi]=="0" ) ? $this->ebf : $this->ebg;
					$this->tamanhoTotal = $this->tamanhoTotal + $imgWid;
				}
				$this->tamanhoTotal = (int) ($this->tamanhoTotal * 1.1);

				header("Content-type: image/png");
				

				$barra_imagem = imagecreate($this->tamanhoTotal,$this->altb);
				

				$branco = imagecolorallocate($barra_imagem,255,255,255);
				$preto	= imagecolorallocate($barra_imagem,0,0,0);
			}
			
			

			$this->tamanhoTotal = 0;
	        for( $xi=0; $xi<= $lbc; $xi++ )
	        {
	            $imgBar = "";
	            $imgWid = 0;
	            
	            $imgWid = ( $this->bc_string[$xi]=="0" ) ? $this->ebf : $this->ebg;
	            

				if($this->tipoRetorno == 0)	{

					$imgBar = ( $xi % 2 == 0 ) ? $this->ipp : $this->ipb;
					$barra_html = $barra_html .
								  "<img src=\"". $imgBar .
								  "\" width=\"". $imgWid .
								  "\" height=\"". $this->altb .
								  "\" border=\"0\">";
				} else if($this->tipoRetorno == 1) {
					$corBarra = ( $xi % 2 == 0 ) ? $preto : $branco;
					
					for($linx = 1; $linx <= $imgWid; $linx++) 
						imageline($barra_imagem, $this->tamanhoTotal+$linx, 0, $this->tamanhoTotal+$linx, $this->altb , $corBarra);	
				
				}
	
	            $this->tamanhoTotal = $this->tamanhoTotal + $imgWid;
	        }
	        
	        $this->tamanhoTotal = (int) ($this->tamanhoTotal * 1.2);
			
			if($this->tipoRetorno == 0) {
				if (!$this->ignoreTable) {
					$barra_html = "<TABLE BORDER=1 CELLPADDING=0 align='left' CELLSPACING=0 WIDTH=".$this->tamanhoTotal."><TR><TD WIDTH=100%>" .
								   $barra_html . "</TD></TR></TABLE>";
				}
				
				echo "<div align=\"center\">$barra_html</div>\n";
			} else if($this->tipoRetorno == 1) {
				imagepng($barra_imagem);
				imagedestroy($barra_imagem);
			}
		}
        
    }//End of drawBrar
    
    function MixCode()
    {
        //Faz a mixagem do valor a ser codificado pelo Código de Barras I25
        //Declaração de Variaveis
        $i = 0; $l = 0; $k = 0;  //inteiro, inteiro, longo
        $s = "";                 //String
        
        $l = strlen( $this->bc_string );
        
        if ( ( $l % 5 ) != 0 || ( $l % 2 ) != 0 )
        {
            $this->barra_html = "<b> code invalide.</b>";
        }
        else
        {
            $s = "";
            for ( $i = 0; $i< $l; $i += 10 )
            {
                $s = $s . $this->bc_string[$i]   .  $this->bc_string[$i+5];
                $s = $s . $this->bc_string[$i+1] .  $this->bc_string[$i+6];
                $s = $s . $this->bc_string[$i+2] .  $this->bc_string[$i+7];
                $s = $s . $this->bc_string[$i+3] .  $this->bc_string[$i+8];
                $s = $s . $this->bc_string[$i+4] .  $this->bc_string[$i+9];
            }
            $this->bc_string = $s;
        }
    }//End of mixCode
    
}//End of Class

?>
