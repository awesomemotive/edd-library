---
layout: page
title: Downloads
permalink: /downloads/
category: downloads
---

<ul>
{% for item in site.downloads %}
  <li><a href="{{ item.url }}">{{ item.title }}</a>
    - {{ item.description }}
  </li>
{% endfor %}
</ul>