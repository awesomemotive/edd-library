---
layout: page
title: Commissions
permalink: /extensions/commissions/
collection: extensions
category: extensions
---

<ul>
{% for item in site.extensions %}
    {% if item.category == 'commissions' %}
      <li><a href="{{ item.url }}">{{ item.title }}</a>
        - {{ item.description }}
      </li>
  {% endif %}
{% endfor %}
</ul>