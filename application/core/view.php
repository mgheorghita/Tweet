<?php

class View
{

	function generate($content_view, $template_view, $data = array())
	{
		
		/*
		if(is_array($data)) {

			extract($data);
		}
		*/

		include 'application/views/'.$template_view;
	}
}