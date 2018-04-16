---
layout: page
title: Miscellaneous
permalink: /misc/
category: misc
---

<ul>
{% for item in site.misc %}
  <li><a href="{{ item.url }}">{{ item.title }}</a>
    - {{ item.description }}
  </li>
{% endfor %}
</ul>