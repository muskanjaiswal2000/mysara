@extends('layouts.app')
@section('body-class', 'page-news')

@section('title', \MySara\Common\Libraries\MetaInfo::getInstance($catalog)->getTitle())
@section('description', \MySara\Common\Libraries\MetaInfo::getInstance($catalog)->getDescription())
@section('keywords', \MySara\Common\Libraries\MetaInfo::getInstance($catalog)->getKeywords())

@section('content')

  <x-front-breadcrumb type="catalog" :value="$catalog"/>

  @hookinsert('catalog.show.top')

  @include('shared.articles')

  @hookinsert('catalog.show.bottom')

@endsection

