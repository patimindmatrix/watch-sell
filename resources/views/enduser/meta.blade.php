<title>{{ @$title }}</title>
<!--- META FOR FACEBOOK ---->
<meta content="{{ @$title }}" property="og:site_name"/>
<meta property="og:type" content="website">
<meta property="og:url" itemprop="url" content="{{ @$url }}"/>
<meta property="og:image" itemprop="thumbnailUrl" content="{{ asset("picture/icon.png") }}"/>
<meta content="{{ @$title }}" itemprop="headline" property="og:title"/>
<meta content="{{ @$description }}" itemprop="description" property="og:description"/>
<!--- END FOR FACEBOOK ---->
