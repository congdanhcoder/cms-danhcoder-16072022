<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <base href="http://localhost:88/danhcoder"> -->
    <!-- import boostrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- import font awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- import Codemirror -->
    <link rel="stylesheet" href="{{ asset('public/plugins/codemirror5.6/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/codemirror5.6/theme/dracula.css') }}">

    <!-- css main -->
    <link rel="stylesheet" href="{{ asset('resources/admin/css/style.css') }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('resources/admin/images/shortcut-icon-ad.png') }}">
    <title>Document</title>
    <base href="http://localhost:88/danhcoder/">
</head>

<body>
    <div class=".container-fluid dl-flex">