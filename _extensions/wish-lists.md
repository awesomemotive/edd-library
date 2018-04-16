---
layout: page
title: Wish Lists
permalink: /extensions/wish-lists/
collection: extensions
category: extensions
---

<ul>
{% for item in site.extensions %}
    {% if item.category == 'wish-lists' %}
      <li><a href="{{ item.url }}">{{ item.title }}</a>
        - {{ item.description }}
      </li>
  {% endif %}
{% endfor %}
</ul>