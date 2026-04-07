<?php

it('renders the home page', function () {
    $this->get(route('home'))->assertOk();
});

it('renders the about page', function () {
    $this->get(route('about.index'))->assertOk();
});

it('renders the what we do page', function () {
    $this->get(route('about.what-we-do'))->assertOk();
});

it('renders the awards page', function () {
    $this->get(route('awards'))->assertOk();
});

it('renders the projects index page', function () {
    $this->get(route('projects.index'))->assertOk();
});

it('renders the blog index page', function () {
    $this->get(route('blog.index'))->assertOk();
});

it('renders the gallery page', function () {
    $this->get(route('gallery'))->assertOk();
});

it('renders the reports page', function () {
    $this->get(route('reports'))->assertOk();
});

it('renders the careers page', function () {
    $this->get(route('careers'))->assertOk();
});

it('renders the contact page', function () {
    $this->get(route('contact'))->assertOk();
});

it('renders the donate page', function () {
    $this->get(route('donate'))->assertOk();
});

it('renders the donate success page', function () {
    $this->get(route('donate.success'))->assertOk();
});

it('renders the donate failed page', function () {
    $this->get(route('donate.failed'))->assertOk();
});

it('renders the donate pending page', function () {
    $this->get(route('donate.pending'))->assertOk();
});

it('renders the privacy policy page', function () {
    $this->get(route('privacy'))->assertOk();
});

it('renders the terms of service page', function () {
    $this->get(route('terms'))->assertOk();
});
