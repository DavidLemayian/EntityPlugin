@extends('layouts.master')

@section('title')
@parent
:: Login
@stop

@section('styles')
	<style>
		body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		
		.form-signin {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
		  margin-bottom: 10px;
		}
		.form-signin .checkbox {
		  font-weight: normal;
		}
		.form-signin .form-control {
		  position: relative;
		  font-size: 16px;
		  height: auto;
		  padding: 10px;
		  -webkit-box-sizing: border-box;
		     -moz-box-sizing: border-box;
		          box-sizing: border-box;
		}
		.form-signin .form-control:focus {
		  z-index: 2;
		}
		.form-signin input[type="text"] {
		  margin-bottom: -1px;
		  border-bottom-left-radius: 0;
		  border-bottom-right-radius: 0;
		}
		.form-signin input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
		nav {
			display: none;
		}
	</style>
@stop

{{-- Content --}}
@section('content')
	
	<div class="container">
	
		<form class="form-signin" role="form" action="">
			<h2 class="form-signin-heading">Please Sign In</h2>
			<hr />
			<p>Use your <a href="https://sourceafrica.net/" target="_blank"><span class="label label-primary">sourceAFRICA</span></a> credentials to sign into the entity plugin.</p>
			<input id="in-email" type="text" class="form-control" placeholder="Email address" required autofocus>
			<input id="in-pass" type="password" class="form-control" placeholder="Password" required>
			<p id="msg-error" class="text-danger"></p>
			<label class="checkbox">
				<input type="checkbox" value="remember-me"> Remember me
			</label>
			<button id="btn-signin" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			
		</form>
		
		<form method="post" action="/login" id="form-login">
			<input id="form-email" type="hidden" name="email" value="">
			<input id="form-password" type="hidden" name="password" value="">
			<input id="csrf_token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		</form>
	
	</div> <!-- /container -->
	
@stop

@section('scripts')
	<script type="text/javascript">
		$( ".form-signin" ).submit(function( event ) {
			event.preventDefault();
			
			$('#msg-error').html('');
			$("#btn-signin").html('Please wait...');
			$('#in-email').prop('disabled', true);
			$('#in-pass').prop('disabled', true);
			$('#in-email').attr('disabled', true);
			$('#in-pass').attr('disabled', true);
			
			var user = $('#in-email').val();
			var pass = $('#in-pass').val();
			
			var auth = Base64.encode(user + ':' + pass);
			var url = 'https://sourceafrica.net/api/projects.json';
			
			// jQuery
			$.ajax({
			    url : url,
			    method : 'GET',
			    beforeSend : function(req) {
			        req.setRequestHeader('Authorization', "Basic " + auth);
			    }
			}).done(function( msg ) {
				$( "#form-email" ).val(user);				
				$( "#form-password" ).val(pass);				
				$( "#form-login" ).submit();
				
				//alert(msg.projects);
			}).fail(function() {
				$('#msg-error').html('Error: Please check your email or password.');
			    $("#btn-signin").html('Sign In');
			    $('#in-email').removeAttr('disabled');
			    $('#in-pass').removeAttr('disabled');
			    $('#in-pass').val('');
			});
			
		});
	</script>
	
	<!-- Base64 Encode -->
	<script type="text/javascript">
		/**
		*
		*  Base64 encode / decode
		*  http://www.webtoolkit.info/
		*
		**/
		 
		var Base64 = {
		 
			// private property
			_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
		 
			// public method for encoding
			encode : function (input) {
				var output = "";
				var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
				var i = 0;
		 
				input = Base64._utf8_encode(input);
		 
				while (i < input.length) {
		 
					chr1 = input.charCodeAt(i++);
					chr2 = input.charCodeAt(i++);
					chr3 = input.charCodeAt(i++);
		 
					enc1 = chr1 >> 2;
					enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
					enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
					enc4 = chr3 & 63;
		 
					if (isNaN(chr2)) {
						enc3 = enc4 = 64;
					} else if (isNaN(chr3)) {
						enc4 = 64;
					}
		 
					output = output +
					this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
					this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
		 
				}
		 
				return output;
			},
		 
			// public method for decoding
			decode : function (input) {
				var output = "";
				var chr1, chr2, chr3;
				var enc1, enc2, enc3, enc4;
				var i = 0;
		 
				input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
		 
				while (i < input.length) {
		 
					enc1 = this._keyStr.indexOf(input.charAt(i++));
					enc2 = this._keyStr.indexOf(input.charAt(i++));
					enc3 = this._keyStr.indexOf(input.charAt(i++));
					enc4 = this._keyStr.indexOf(input.charAt(i++));
		 
					chr1 = (enc1 << 2) | (enc2 >> 4);
					chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
					chr3 = ((enc3 & 3) << 6) | enc4;
		 
					output = output + String.fromCharCode(chr1);
		 
					if (enc3 != 64) {
						output = output + String.fromCharCode(chr2);
					}
					if (enc4 != 64) {
						output = output + String.fromCharCode(chr3);
					}
		 
				}
		 
				output = Base64._utf8_decode(output);
		 
				return output;
		 
			},
		 
			// private method for UTF-8 encoding
			_utf8_encode : function (string) {
				string = string.replace(/\r\n/g,"\n");
				var utftext = "";
		 
				for (var n = 0; n < string.length; n++) {
		 
					var c = string.charCodeAt(n);
		 
					if (c < 128) {
						utftext += String.fromCharCode(c);
					}
					else if((c > 127) && (c < 2048)) {
						utftext += String.fromCharCode((c >> 6) | 192);
						utftext += String.fromCharCode((c & 63) | 128);
					}
					else {
						utftext += String.fromCharCode((c >> 12) | 224);
						utftext += String.fromCharCode(((c >> 6) & 63) | 128);
						utftext += String.fromCharCode((c & 63) | 128);
					}
		 
				}
		 
				return utftext;
			},
		 
			// private method for UTF-8 decoding
			_utf8_decode : function (utftext) {
				var string = "";
				var i = 0;
				var c = c1 = c2 = 0;
		 
				while ( i < utftext.length ) {
		 
					c = utftext.charCodeAt(i);
		 
					if (c < 128) {
						string += String.fromCharCode(c);
						i++;
					}
					else if((c > 191) && (c < 224)) {
						c2 = utftext.charCodeAt(i+1);
						string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
						i += 2;
					}
					else {
						c2 = utftext.charCodeAt(i+1);
						c3 = utftext.charCodeAt(i+2);
						string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
						i += 3;
					}
		 
				}
		 
				return string;
			}
		 
		}
	</script>
@stop
