# Features

## Sessions
 - Login: Display a form to log the user in if he is guest.
 - Logout: Display a form to log the user out if he is authenticated.
 - Password Reminder: 2-steps password retrival.
 - Account activation: Activate an user after registration.

## Users
 - Create(register): Display a form to register the user if he is guest.
 - Show(profile): Display the user's informations (profile).
 - Update(settings): Display a form to change the user's settings (password, names, avatar,...)

## Admin
To display all those features, the user must be authenticated with an admin profile. In the Admin Panel, you can manage users, groups and permissions, general application settings, blog with tags, CMS pages, SEO settings.

    

### Users
 - Index: Display all the users.
 - Update: Display a form to change the user's settings (password, names, avatar,...).
 - Create: Display a form to insert an user.
 - Show: Display the user's informations (profile).
 - Delete: Delete the current user.
 - Ban: Ban the current user (date_end).
 - Unban: Unban the current user.

### Groups & permissions
 - Index: Display all the groups and permissions.
 - Update: Display a form to change the group's settings.
 - Create: Display a form to insert a new group with his permissions.
 - Show: Display the group's informations.
 - Delete: Delete the current group.

### Blog
 - Index: Display all the posts.
 - Update: Display a form to change the post.
 - Create: Display a form to insert a new post.
 - Show: Preview the blog post.
 - Publish: Publish the current post (publish boolean, published_at date option).
 - UnPublish: UnPublish the current post.
 - Delete: Delete the current post.

### Portfolio
 - Index: Display all the posts.
 - Update: Display a form to change the post.
 - Create: Display a form to insert a new post.
 - Show: Preview the portfolio post.
 - Publish: Publish the current post (publish boolean, published_at date option).
 - UnPublish: UnPublish the current post.
 - Delete: Delete the current post.

### Page
 - Index: Display all the pages.
 - Update: Display a form to change the page.
 - Create: Display a form to insert a new page.
 - Show: Preview the page.
 - Publish: Publish the current page (publish boolean, published_at date option).
 - UnPublish: UnPublish the current page.
 - Delete: Delete the current page.

### Tags
 - Index: Display all the tags.
 - Update: Display a form to change the tag.
 - Create: Display a form to insert a new tag.
 - Show: Preview the blog posts related to the tag.
 - Delete: Delete the current tag and cascade the affected posts.

### Settings
 - Get the settings of the application such as the website name, website url. It is extracted from the application configuration files.

### SEO
 - Index: Display all the pages, blog posts, portfolio posts.
 - Update: Display a form to change the item SEO settings.
 - Show: Preview the item's SEO settings.

##Models

    User {
        id
        username(string, unique, index)
        email(string, unique, email)
        password(string)
        first_name(string, nullable)
        last_name(string, nullable)
        location(string, nullable)
        bio(string, nullable)
        avatar(string, nullable)
        group_id(Group)
        suspended(boolean, default 0)
        activated(boolean, default 0)
        activation_code(string)
        suspended_until(datetime)
        timestamps
    }

-----

    Group {
        id
        title(string, index)
        description(string)
        permissions(array)
        timestamps
    }

-----

    Post {
        id
        title(string, index)
        slug(string, unique, index)
        content(text)
        excerpt(text, nullable)
        image(string, nullable)
        type(enum[blog, portfolio, page])
        published(boolean, default 0)
        published_at(datetime, default NOW())
        timestamps
    }
    
-----

    Tag {
        id
        title(string, index)
        slug(string, unique, index)
        description(text, nullable)
        timestamps
    }