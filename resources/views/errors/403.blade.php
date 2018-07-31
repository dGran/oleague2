@extends('errors::layout')

@section('title', 403)
@section('message', $exception->getMessage())