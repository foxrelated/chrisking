

var proxy_url = 'proxy.php';
var $progressbar = $( "#progressbar" );

function start_video_generation()
{
	$('#generate').hide();
	$('#getStatus').show();
	var jqxhr = $.ajax( proxy_url+'?action=generate' )
		.done(function(data) 
		{
			console.log(data);
			console.log( "done" );
			setTimeout(getStatus, 2000);
		})
		.fail(function() 
		{
			console.log( "fail" );
		})
		.always(function() 
		{
			console.log( "always" );
		});
}

function get_status()
{
	var jqxhr = $.ajax( proxy_url+'?action=getStatus' )
		.done(function(data) 
		{
			console.log(data);
			process_status(data);
			console.log( "done" );
		})
		.fail(function() 
		{
			console.log( "fail" );
		})
		.always(function() 
		{
			console.log( "always" );
		});
}

function process_status(data)
{
	var status = data[0].status // get the status of the first profile
	
	if(status.error)
	{
		console.log(status.error);
	}
	else
	{
		
		// update the view
		var percent = {
			'queued': 10,
			'starting': 20,
			'downloading': 25,
			'info': 29,
			'generating': 30 + Math.round(status.complete * 0.6),
			'uploading': 99
		}[status.status];
		
		$progressbar.progressbar({value: percent});
		
		if(status['available-0-url'])
		{ // the first upload is complete (stupeflix default upload in our case)
			getVideoUrl();
		}
		else
		{
			// poll for the generation status every 2 seconds
			setTimeout(getStatus, 2000);
		}
	}
}

function getVideoUrl()
{
	$('#getStatus').hide();
	$('#getVideoUrl').show();
	
	var jqxhr = $.ajax( proxy_url+'?action=getVideoUrl' )
		.done(function(data) 
		{
			console.log(data);
			$('#videoUrl').attr('href', data);
			console.log( "done" );
		})
		.fail(function() 
		{
			console.log( "fail" );
		})
		.always(function() 
		{
			console.log( "always" );
		});
}


/* start everything up */
$(function() 
{
	console.log('document ready');
});


/*
var PgBar = {
	
	initialize: function()
	{
		this.view = new Element('div').addClass('PgBar');
		this.inner = this.view.appendChild(new Element('div').addClass('inner'));
	},
	
	_buildProxyUrl: function(action){
		return "./proxy.php?action=" + action;
	},
		
	start: function(successCallback, errorCallback)
	{
		
		this.inner.style.width = "0%";
		this._successCallback = successCallback;
		this._errorCallback = errorCallback;
		
		new Request.JSON({ method: "get", url: this._buildProxyUrl('generate'),
			onComplete: function(response){
				if(response.error){
					this._errorCallback(response.error);
				}else{
					this.getStatus();
				}
			}.bind(this)
		}).send();
	},
	
	getStatus: function(){
		clearTimeout(this._statusTimer);
		new Request.JSON({ method: "get", url: this._buildProxyUrl('getStatus'),
			onComplete: this._processStatus.bind(this)
		}).send();
	},
	
	_processStatus: function(data){
		var status = data[0].status // get the status of the first profile
		
		if(status.error)
		{
			this._errorCallback(status.error);
		}
		else
		{
			
			// update the view
			var percent = {
				'queued': 10,
				'starting': 20,
				'downloading': 25,
				'info': 29,
				'generating': 30 + Math.round(status.complete * 0.6),
				'uploading': 99
			}[status.status];
			this.inner.style.width = percent + "%";
			
			if(status['available-0-url']){ // the first upload is complete (stupeflix default upload in our case)
				this._getVideoUrl();
			}else{
				// poll for the generation status every 2 seconds
				this._statusTimer = setTimeout(this.getStatus.bind(this), 2000);
			}
		}
	},
	
	_getVideoUrl: function(){
		new Request.JSON({ method: "get", url: this._buildProxyUrl('getVideoUrl'),
			onComplete: this._successCallback
		}).send();
	}
	
}
*/
