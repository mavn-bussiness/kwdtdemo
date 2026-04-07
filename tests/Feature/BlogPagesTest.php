<?php

it('renders the home page successfully', function () {
    $this->get(route('home'))->assertOk();
});

it('renders the blog index page successfully', function () {
    $this->get(route('blog.index'))->assertOk();
});

it('renders the projects index page successfully', function () {
    $this->get(route('projects.index'))->assertOk();
});

it('renders the about page successfully', function () {
    $this->get(route('about.index'))->assertOk();
});

it('renders the contact page successfully', function () {
    $this->get(route('contact'))->assertOk();
});

it('renders the donate page successfully', function () {
    $this->get(route('donate'))->assertOk();
});

it('renders the donate success page successfully', function () {
    $this->get(route('donate.success'))->assertOk();
});

it('renders the donate failed page successfully', function () {
    $this->get(route('donate.failed'))->assertOk();
});

it('renders the reports page successfully', function () {
    $this->get(route('reports'))->assertOk();
});

it('renders the privacy policy page successfully', function () {
    $this->get(route('privacy'))->assertOk();
});
