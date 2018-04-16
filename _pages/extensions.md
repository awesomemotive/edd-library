---
layout: page
title: Extensions
permalink: /extensions/
category: extensions
---

<ul>
{% for item in site.extensions %}
    {% if item.category == 'extensions' %}
      <li><a href="{{ item.url }}">{{ item.title }}</a>
      </li>
  {% endif %}
{% endfor %}
</ul>