@extends('emails.base')

@section('content')
	<html>
			  <head>

			  </head>
	<tr>
	 <body>
	  <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:30px">
		 <h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:Nunito, Roboto, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#fdab38"></h1>
		 <h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:Nunito, Roboto, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#fdab38;display:none"><br></h1>
	  </td>
   </tr>
   <tr>
	  <td align="left" class="es-m-txt-l" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
		 <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Nunito, Roboto, sans-serif;line-height:27px;color:#123f88;font-size:18px">

			    <h2>Your new password</h2>

				    {!! $mail !!}
		</p>
	  </td>
   </tr>
	</body>
			</html>
@endsection


