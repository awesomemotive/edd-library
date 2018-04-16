---
layout: page
title: PayPal Adaptive Payments
permalink: /extensions/paypal-adaptive-payments/
collection: extensions
category: extensions
---

<ul>
{% for item in site.extensions %}
    {% if item.category == 'paypal-adaptive-payments' %}
      <li><a href="{{ item.url }}">{{ item.title }}</a>
        - {{ item.description }}
      </li>
  {% endif %}
{% endfor %}
</ul>