---
layout: page
title: Shortcodes
permalink: /shortcodes/
category: shortcodes
---

<ul>
{% for item in site.shortcodes %}
  <li><a href="{{ item.url }}">{{ item.title }}</a>
    - {{ item.description }}
  </li>
{% endfor %}
</ul>