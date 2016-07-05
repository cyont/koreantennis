function validateFormd( )
{
	var objFV = new FormValidator("frm_comment");
	
//	if (!objFV.validate("name", "B", "Please enter your Name."))
//		return false;
//		
//	if (!objFV.validate("email", "E,B", "Please enter your valid Email Address."))
//		return false;
//		
	if (!objFV.validate("comments", "B", "Please enter your Comments/Questions."))
		return false;		

	return true;
}