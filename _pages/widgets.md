---
layout: page
title: Widgets
category: widgets
permalink: /widgets/
---



<ul>
{% for item in site.widgets %}
  <li><a href="{{ item.url }}">{{ item.title }}</a>
    - {{ item.description }}
  </li>
{% endfor %}
</ul>