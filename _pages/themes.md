---
layout: page
title: Themes
permalink: /themes/
category: themes
---

<ul>
{% for item in site.themes %}
  <li><a href="{{ item.url }}">{{ item.title }}</a>
    - {{ item.description }}
  </li>
{% endfor %}
</ul>