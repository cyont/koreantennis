function FormValidator(sForm)
{
	this.objForm = document.sForm;
	
	if (!this.objForm)
		this.objForm = document.getElementById(sForm);
		
	if (!this.objForm)
		alert("Error: Unable to create the Form Object.");	
	
	this.validate = validate;
	this.value = value;
	this.setValue = setValue;
	this.select = select;
	this.focus = focus;
	this.checked = checked;
	this.selectedValue = selectedValue;	
}

function checked(eField)
{
	return this.objForm[eField].checked;
}

function selectedValue(eField)
{
	var iLength = this.objForm[eField].length;

	for (var i = 0; i < iLength; i ++)
	{
		if (this.objForm[eField][i].checked == true)
			return this.objForm[eField][i].value;
	}
}

function value(eField)
{
	return this.objForm[eField].value;
}

function setValue(eField, sValue)
{
	this.objForm[eField].value = sValue;
}

function select(eField)
{
	this.objForm[eField].select( );
}

function focus(eField)
{
	this.objForm[eField].focus( );
}

////////////////////// Input Checks
//  B = BLANK
//  C = ALPHABETS
//  N = NUMBER
//  E = EMAIL
//  F = FLOATING NUMBER
//  S = SIGNED
//  L(N) = Length (Minium)

function validate(eField, sChecks, sMsg)
{
	sChecks = trim(sChecks);
	
	var sCheckOptions = new Array( );
	
	var i = 0;
	var iLength = 0;
	var bSigned = false;

	while (sChecks != "")
	{
 		var sTemp = "";
 		
 		if (sChecks.indexOf(',') == -1)
		{
 			sTemp = sChecks;
 			
 			sChecks = "";
 		}
 			
 		else
 		{
 			sTemp = sChecks.substring(0, sChecks.indexOf(','));

 			sChecks = sChecks.substring(sChecks.indexOf(',') + 1);
		}
		
 		if (sTemp.charAt(0) == "L")
 		{
 			iLength = parseInt(sTemp.substring(2, (sTemp.length - 1)));
 			
 			sTemp = "L";
 		}
 		
 		else if (sTemp.charAt(0) == "S")
 		{
 			bSigned = true;
 			
 			continue;
 		}
 		

		sCheckOptions.push(sTemp);
	}
	
	for (var i = 0; i < sCheckOptions.length; i ++)
	{
		switch(sCheckOptions[i])
		{		           
			case "B" : if (this.objForm[eField].value == "")
			           {
			           	alert(sMsg);
			           	
			           	this.objForm[eField].focus( );
			           	
			           	return false;
			           }
			           
			           break;


			case "C" : if (!validateAlphabetFormat(this.objForm[eField].value))
			           {
			           	alert(sMsg);
			           	
			           	this.objForm[eField].focus( );
			           	this.objForm[eField].select( );
			           	
			           	return false;
			           }
			           
			           break;
			           

			case "N" : if (!validateNumberFormat(this.objForm[eField].value, bSigned, false))
			           {
			           	alert(sMsg);
			           	
			           	this.objForm[eField].focus( );
			           	this.objForm[eField].select( );
			           	
			           	return false;
			           }
			           
			           break;
			           
			           
			case "F" : if (!validateNumberFormat(this.objForm[eField].value, bSigned, true))
			           {
			           	alert(sMsg);
			           	
			           	this.objForm[eField].focus( );
			           	this.objForm[eField].select( );
			           	
			           	return false;
			           }
			           
			           break;			           
			           
			           
			case "E" : if (!validateEmailFormat(this.objForm[eField].value))
				   {
			           	alert(sMsg);
			           	
			           	this.objForm[eField].focus( );
			           	this.objForm[eField].select( );
			           	
			           	return false;
			           }
			           	
			           break;
			           
			           
			case "L" : if (this.objForm[eField].value.length < iLength)
				   {
			           	alert(sMsg);
			           	
			           	this.objForm[eField].focus( );
			           	this.objForm[eField].select( );
			           	
			           	return false;
			           }
			           	
			           break;			           
		}
	}
	
	return true;
}

function trim(sValue)
{
	if (sValue == null)
		return null;

	for (var i = 0; sValue.charAt(i) == " "; i ++);
	
	sValue = sValue.substring(i,sValue.length);

	if (sValue == null)
		return null;

	for(var i = (sValue.length-1); sValue.charAt(i) == " "; i --);
	
	return sValue.substring(0, (i + 1));
}


function validateEmailFormat(sEmail)
{
	var iLength = sEmail.length;

	if (iLength == 0)
		return true;

	if (iLength < 5)
		return false;

	var sValidChars = "abcdefghijklmnopqrstuvwxyz0123456789@.-_";

	for (var i = 0; i < iLength; i++)
	{
		var sLetter = sEmail.charAt(i).toLowerCase( );

		if (sValidChars.indexOf(sLetter) != -1)
			continue;

		return false;
	}

	var iPosition = sEmail.indexOf('@');

	if (iPosition == -1 || iPosition == 0)
		return false;

	var sFirstPart = sEmail.substring(0, iPosition);

	sEmail = sEmail.substring((iPosition + 1));

	iPosition = sEmail.indexOf('.');

	if (iPosition == -1 || iPosition == 0)
		return false;

	var sSecondPart = sEmail.substring(0, iPosition);

	var sThirdPart = sEmail.substring((iPosition + 1));

	if(sFirstPart.indexOf('-') != -1)
		return false;

	if(sSecondPart.indexOf('@') != -1 || sSecondPart.indexOf('_') != -1)
		return false;

	if(sThirdPart.indexOf('@') != -1 || sThirdPart.indexOf('_') != -1 || sThirdPart.indexOf('-') != -1 || sThirdPart.length < 2)
		return false;

	return true;
}


function validateAlphabetFormat(sText)
{
	var iLength = sText.length;

	if (iLength == 0)
		return true;

	var sValidChars = "abcdefghijklmnopqrstuvwxyz. ";

	for (var i = 0; i < iLength; i++)
	{
		var sLetter = sText.charAt(i).toLowerCase( );

		if (sValidChars.indexOf(sLetter) != -1)
			continue;

		return false;
	}

	return true;
}


function validateNumberFormat(sNumber, bSigned, bFraction)
{
	var sValidCharacters = "0123456789";
	var i = 0;
	
	if (bSigned == true)
	{
		if (sNumber.charAt(0) == "-")
			i ++;
	}
		
	if (bFraction == true)
	{
		if (sNumber.indexOf(".") != sNumber.lastIndexOf("."))
			return false;

		sValidCharacters += ".";
	}
	
	for (; i < sNumber.length; i ++)
	{
		if (sValidCharacters.indexOf(sNumber.charAt(i)) == -1)
			return false;
	}

	return true;
}