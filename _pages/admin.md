---
layout: page
title: Admin
permalink: /admin/
category: admin
---

<ul>
{% for item in site.admin %}
  <li><a href="{{ item.url }}">{{ item.title }}</a>
    - {{ item.description }}
  </li>
{% endfor %}
</ul>