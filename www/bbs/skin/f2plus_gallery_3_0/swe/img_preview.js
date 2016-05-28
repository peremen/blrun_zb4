
//====================[ sw_edit ÆÄÀÏ¸í: img_preview.js ]====================

var sw_newImg = new Image();
var sw_fstr = /(.JPG|.JPEG|.GIF|.PNG|.BMP)$/i;
var imgViewReloadInterval = null;

function imgViewReload()
{		
	memoiE = document.getElementById("memoi");
	memoiW = memoiE.contentWindow;
	
	if(memoiW.document.readyState == "complete")
	{
		clearInterval(imgViewReloadInterval);
		imgfile_in_view();
	}
}

function imgfile_in_view()
{
	var sw_modeE = document.getElementById("sw_mode").value;

	if(sw_modeE == "modify")
	{
		var sw_file_name1E = document.getElementById("sw_file_name1").value;
		var sw_file_name2E = document.getElementById("sw_file_name2").value;
	
		if(sw_file_name1E.match(sw_fstr))
		{
			sw_newImg.src = sw_file_name1E;
	
			var sw_imgSize = sw_newImg.width;
			if (sw_imgSize > 120) { sw_imgWidth = 120; } else { sw_imgWidth = sw_imgSize; }

			var img_view_1E = document.getElementById("img_view_1");

			img_view_1E.src = sw_newImg.src;
			img_view_1E.width = sw_imgWidth;
			img_view_1E.style.display = "inline";
		}
		if(sw_file_name2E.match(sw_fstr))
		{
			sw_newImg.src = sw_file_name2E;
	
			var sw_imgSize = sw_newImg.width;
			if (sw_imgSize > 120) { sw_imgWidth = 120; } else { sw_imgWidth = sw_imgSize; }
	
			var img_view_2E = document.getElementById("img_view_2");

			img_view_2E.src = sw_newImg.src;
			img_view_2E.width = sw_imgWidth;
			img_view_2E.style.display = "inline";
		}
	}
}

function imgfile_ad_view() 
{
	img_views = "img_view_" + event.srcElement.name.split("file")[1];
	img_viewsE = document.getElementById(img_views);

	if(event.srcElement.value.match(sw_fstr))
	{
		sw_newImg.src = event.srcElement.value;
		setTimeout("sw_newImg_view()", 300);
	} else {
		img_viewsE.style.display = "none";
	}
}

function sw_newImg_view() 
{
	var sw_imgSize = sw_newImg.width;
	if (sw_imgSize > 120) { sw_imgWidth = 120; } else { sw_imgWidth = sw_imgSize; }

	img_viewsE.src = sw_newImg.src;
	img_viewsE.width = sw_imgWidth;
	img_viewsE.style.display = "inline";
}
