---
layout: page
title: Auto Register
permalink: /extensions/auto-register/
collection: extensions
category: extensions
---

<ul>
{% for item in site.extensions %}
    {% if item.category == 'auto-register' %}
      <li><a href="{{ item.url }}">{{ item.title }}</a>
        - {{ item.description }}
      </li>
  {% endif %}
{% endfor %}
</ul>