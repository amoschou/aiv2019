@extends('errors::layout')

@section('title', '400 Bad request')

@section('message', $exception->getMessage())