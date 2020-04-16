Each page with logic (in most cases) should be separated to: Container and Component

Container - contain all logic and redux bindings, control all actions and other
Component - control view logic can be, and in most cases should be, split to smaller components 


Independent components can contain their own logic (like global statistic or notifications block similar on several pages)

Also we should keep balance between composition and deep passing of data
